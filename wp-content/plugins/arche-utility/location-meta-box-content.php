<table class="form-table" id="lmb-form-table">
	<tbody>
		<tr>
			<th scope="row"><label for="lmb_geocomplete">Full address</label></th>
			<td>
				<input id="lmb_geocomplete" name="lmb_address[raw]" class="large-text" type="text" placeholder="Type in an address" value="<?php echo esc_attr( $address['raw'] ); ?>" />
				<input id="lat" name="lmb_lat" type="hidden" value="<?php echo esc_attr( $lat ); ?>">
				<input id="lng" name="lmb_lng" type="hidden" value="<?php echo esc_attr( $lng ); ?>">
			</td>
		</tr>
		<tr>
			<th scope="row"></th>
			<td>
				<div class="map-container">
					<div id="lmb_map"></div>
				</div>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="formatted_address">Formatted Address</label>
			</th>
			<td>
				<input id="formatted_address" name="lmb_address[formatted]" class="large-text" type="text" value="<?php echo esc_attr( $address['formatted'] ); ?>">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="route">Street</label>
			</th>
			<td>
				<input id="route" name="lmb_address[street]" class="regular-text" type="text" value="<?php echo esc_attr( $address['street'] ); ?>">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="street_number">Street Number</label>
			</th>
			<td>
				<input id="street_number" name="lmb_address[streetnumber]" class="regular-text" type="text" value="<?php echo esc_attr( $address['streetnumber'] ); ?>">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="postal_code">Postal Code</label>
			</th>
			<td>
				<input id="postal_code" name="lmb_address[postal]" class="regular-text" type="text" value="<?php echo esc_attr( $address['postal'] ); ?>">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="locality">City</label>
			</th>
			<td>
				<input id="locality" name="lmb_address[city]" class="regular-text" type="text" value="<?php echo esc_attr( $address['city'] ); ?>">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="administrative_area_level_1">State</label>
			</th>
			<td>
				<input id="administrative_area_level_1" name="lmb_address[state]" class="regular-text" type="text" value="<?php echo esc_attr( $address['state'] ); ?>">
				<input id="administrative_area_level_1_short" name="lmb_address[state_short]" class="small-text" type="text" value="<?php echo esc_attr( $address['state_short'] ); ?>">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="country">Country</label>
			</th>
			<td>
				<input id="country" name="lmb_address[country]" class="regular-text" type="text" value="<?php echo esc_attr( $address['country'] ); ?>">
			</td>
		</tr>
	</tbody>
</table>
<script>
  jQuery(function($){
  	var input, map, lat, lng, center, marker;
    input = $("#lmb_geocomplete").geocomplete({
      map: "#lmb_map",
      details: "#lmb-form-table",
      detailsAttribute: 'id',
      types: ["geocode", "establishment"],
    });

    map = input.geocomplete("map");
    marker = input.geocomplete("marker");
    lat = $('#lat');
    lng = $('#lng');
    if('' !== lat.val() && '' !== lng.val()) {
    	center = new google.maps.LatLng(lat.val(), lng.val());
    	map.setCenter(center);
    	marker.setPosition(center);
    }
  });
</script>
