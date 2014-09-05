<?php
/**
 * Arche_Location_Query
 *
 * @package     Arche
 * @author      Thijs Huijssoon <thuijssoon@googlemail.com>
 * @license     GPL-2.0+
 * @link        http://github.com/thuijssoon/easy-store-locator/
 * @copyright   2013 Thijs Huijssoon
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Arche_Location_Query
 *
 * @package     Arche
 * @subpackage  Public
 * @author      Thijs Huijssoon <thuijssoon@googlemail.com>
 */
if ( !class_exists( 'Arche_Location_Query' ) ) {

    class Arche_Location_Query extends WP_Query {
        var $distance, $distance_unit = 'km', $LatLngBounds, $LatLng, $is_open, $orderby;

        function __construct( $args=array() ) {

            if ( !empty( $args['distance_unit'] ) && 'km' !== $args['distance_unit'] ) {
                $this->distance_unit = 'mi';
            }

            if (
                !empty( $args['latlng'] ) &&
                is_array( $args['latlng'] ) &&
                !empty( $args['latlng']['lat'] ) &&
                !empty( $args['latlng']['lng'] ) &&
                !empty( $args['distance'] )
            ) {
                $this->distance      = intval( $args['distance'] );
                $this->LatLng        = array();
                $this->LatLng['lat'] = floatval( $args['latlng']['lat'] );
                $this->LatLng['lng'] = floatval( $args['latlng']['lng'] );

                add_filter( 'posts_clauses', array( $this, 'posts_clauses' ) );
            }

            if (
                !empty( $args['LatLngBounds'] ) &&
                is_array( $args['LatLngBounds'] ) &&
                !empty( $args['LatLngBounds']['sw'] ) &&
                is_array( $args['LatLngBounds']['sw'] ) &&
                !empty( $args['LatLngBounds']['ne'] ) &&
                is_array( $args['LatLngBounds']['ne'] ) &&
                !empty( $args['LatLngBounds']['sw']['lat'] ) &&
                !empty( $args['LatLngBounds']['sw']['lng'] ) &&
                !empty( $args['LatLngBounds']['ne']['lat'] ) &&
                !empty( $args['LatLngBounds']['ne']['lng'] )
            ) {
                $this->LatLngBounds              = array();
                $this->LatLngBounds['ne']        = array();
                $this->LatLngBounds['sw']        = array();
                $this->LatLngBounds['ne']['lat'] = floatval( $args['LatLngBounds']['ne']['lat'] );
                $this->LatLngBounds['ne']['lng'] = floatval( $args['LatLngBounds']['ne']['lng'] );
                $this->LatLngBounds['sw']['lat'] = floatval( $args['LatLngBounds']['sw']['lat'] );
                $this->LatLngBounds['sw']['lng'] = floatval( $args['LatLngBounds']['sw']['lng'] );
            }

            if ( empty( $this->LatLngBounds ) && empty( $this->LatLng ) ) {
                if ( WP_DEBUG ) {
                    trigger_error( __( 'Missing LatLng and LatLngBounds', 'easy-store-locator' ) );
                }
            }

            if ( isset( $args['post_type'] ) ) {
                if ( !is_array( $args['post_type'] ) ) {
                    $args['post_type'] = array( $args['post_type'] );
                }
                $args['post_type'] = array_intersect( $args['post_type'], array('location') );

                if ( !count( $args['post_type'] ) ) {
                    $args['post_type'] = array('location');
                }
            } else {
                $args['post_type'] = array('location');
            }

            $this->orderby = $args['orderby'];

            parent::__construct( $args );

            remove_filter( 'posts_clauses', array( $this, 'posts_clauses' ) );
            
        }

        function posts_clauses( $pieces ) {
            global $wpdb;

            $earth_radius     = '6371';
            $distance_km      = $this->distance;


            if ( 'mi' === $this->distance_unit ) {
                $earth_radius = '3959';
                $distance_km  = $this->distance * 1.60934;
            }


            $pieces['join']  .= " INNER JOIN {$wpdb->postmeta} AS latitude ON {$wpdb->posts}.ID = latitude.post_id ";
            $pieces['join']  .= " INNER JOIN {$wpdb->postmeta} AS longitude ON {$wpdb->posts}.ID = longitude.post_id ";            
            $pieces['where'] .= ' AND latitude.meta_key = "_lmb_lat" ';
            $pieces['where'] .= ' AND longitude.meta_key = "_lmb_lng" ';

            // Proximity query, source: http://www.arubin.org/files/geo_search.pdf
            if ( !empty( $this->LatLng ) ) {

                $this->LatLngBounds              = array();
                $this->LatLngBounds['ne']        = array();
                $this->LatLngBounds['sw']        = array();
                $this->LatLngBounds['ne']['lat'] = $this->LatLng['lat'] + ( $distance_km / 111.045 );
                $this->LatLngBounds['ne']['lng'] = $this->LatLng['lng'] + $distance_km / abs( cos( deg2rad( $this->LatLng['lat'] ) ) * 111.045 );
                $this->LatLngBounds['sw']['lat'] = $this->LatLng['lat'] - ( $distance_km / 111.045 );
                $this->LatLngBounds['sw']['lng'] = $this->LatLng['lng'] - $distance_km / abs( cos( deg2rad( $this->LatLng['lat'] ) ) * 111.045 );

                $pieces['fields'] .= sprintf( ', %s * 2 * ASIN(SQRT(POWER(SIN((%s - abs(latitude.meta_value)) * pi()/180 / 2), 2) + COS(%s * pi()/180 ) * COS(abs(latitude.meta_value) * pi()/180) * POWER(SIN((%s - longitude.meta_value) * pi()/180 / 2), 2) )) as distance',
                    $earth_radius,
                    $this->LatLng['lat'],
                    $this->LatLng['lat'],
                    $this->LatLng['lng']
                );

                if ( 'distance' === $this->orderby ) {
                    $pieces['orderby'] = 'distance';
                }

            }

            if ( !empty( $this->LatLngBounds ) ) {
                $pieces['where']  .= sprintf( ' AND longitude.meta_value BETWEEN %s AND %s AND latitude.meta_value BETWEEN %s AND %s',
                    $this->LatLngBounds['sw']['lng'],
                    $this->LatLngBounds['ne']['lng'],
                    $this->LatLngBounds['sw']['lat'],
                    $this->LatLngBounds['ne']['lat']
                );
            }

            // Make sure all 'WHERE' clauses have been added before adding the 'HAVING' clause.
            if ( !empty( $this->LatLng ) ) {
                if ( empty( $pieces['groupby'] ) ) {
                    $pieces['where']  .=  sprintf( ' HAVING distance < %s', $this->distance );
                } else {
                    $pieces['groupby']  .= sprintf( ' HAVING distance < %s', $this->distance );
                }
            }

            return $pieces;
        }

    }

}
