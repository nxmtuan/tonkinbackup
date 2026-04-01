<?php
// Fetch stations from API
$stations = tonkin_get_stations();
?>
<section class="form_date-search">
	<div class="container-large">
		<div class="container_flexible_newsletter">
			<div class="container_title mb-5">
				<?php if (get_field('cdc_form_title', 'option')): ?>
					<h3 class="the-subtitle"><?php the_field('cdc_form_title', 'option'); ?></h3>
				<?php endif; ?>
				<?php if (get_field('cdc_form_desc', 'option')): ?>
					<span class="label"><?php the_field('cdc_form_desc', 'option'); ?></span>
				<?php endif; ?>
			</div>
			<div class="row reserv-panel justify-content-center">
				<div class="col-12 reserv-in col-lg-11">
					<form id="stationSearchForm" class="px-3 py-2 form-check position-relative" action="#">
						<div class="row align-items-center">
							<!-- Station Selection -->
							<div class="col-12 col-lg-4">
								<div class="station-selects d-flex align-items-center">
									<div class="station-select-wrapper">
										<select id="fromStation" name="fromStation" class="station-select">
											<?php 
											$index = 0;
											foreach ($stations as $station): 
												$selected = ($index === 0) ? 'selected' : '';
											?>
												<option value="<?php echo esc_attr($station['id']); ?>"
													data-slug="<?php echo esc_attr($station['slug']); ?>"
													<?php echo $selected; ?>>
													<?php echo esc_html($station['name']); ?>
												</option>
											<?php 
												$index++;
											endforeach; 
											?>
										</select>
									</div>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
									<div class="station-select-wrapper">
										<select id="toStation" name="toStation" class="station-select">
											<?php 
											$index = 0;
											foreach ($stations as $station): 
												$selected = ($index === 1) ? 'selected' : '';
												$disabled = ($index === 0) ? 'disabled' : '';
											?>
												<option value="<?php echo esc_attr($station['id']); ?>"
													data-slug="<?php echo esc_attr($station['slug']); ?>"
													<?php echo $selected; ?> <?php echo $disabled; ?>>
													<?php echo esc_html($station['name']); ?>
												</option>
											<?php 
												$index++;
											endforeach; 
											?>
										</select>
									</div>
								</div>
							</div>
							<!-- Date Selection -->
							<div class="col-12 col-lg-4">
								<div class="d-flex align-items-center flex-row">
									<span class="p-2 col-6">
										<input id="checkInInput" class="form-control text-lg-center sedate checkInInput"
											name="checkInDate" type="text" value="">
									</span>
									<span class="p-2 col-6">
										<input id="checkOutInput"
											class="form-control text-lg-center sedate checkOutInput" name="checkOutDate"
											type="text" value="">
									</span>
								</div>
							</div>
							<!-- People & Search -->
							<div class="col-12 col-lg-2 text-lg-left text-center">
								<input id="adults" type="number" class="chk-adults" name="adults" value="1" min="1" max="10">
								<?php _e('people', 'kmar') ?>
							</div>
							<div class="col-12 col-lg-2">
								<button type="submit" class="reserv-btn"><?php _e('Search', 'kmar') ?></button>
							</div>
						</div>

					</form>
				</div>
			</div>

		</div>
	</div>
</section>

<script>
(function() {
	document.addEventListener('DOMContentLoaded', function() {
		const fromStation = document.getElementById('fromStation');
		const toStation = document.getElementById('toStation');
		const form = document.getElementById('stationSearchForm');

		// Function to update disabled options
		function updateDisabledOptions() {
			const fromValue = fromStation.value;
			const toValue = toStation.value;

			// Enable all options first
			Array.from(fromStation.options).forEach(option => {
				option.disabled = false;
			});
			Array.from(toStation.options).forEach(option => {
				option.disabled = false;
			});

			// Disable selected option from the other select
			if (fromValue) {
				const toOption = toStation.querySelector(`option[value="${fromValue}"]`);
				if (toOption) toOption.disabled = true;
			}
			if (toValue) {
				const fromOption = fromStation.querySelector(`option[value="${toValue}"]`);
				if (fromOption) fromOption.disabled = true;
			}
		}

		// Listen for changes
		fromStation.addEventListener('change', function() {
			updateDisabledOptions();
			// If toStation has the same value, select next available
			if (toStation.value === this.value) {
				const nextOption = Array.from(toStation.options).find(opt => !opt.disabled);
				if (nextOption) toStation.value = nextOption.value;
			}
		});

		toStation.addEventListener('change', function() {
			updateDisabledOptions();
			// If fromStation has the same value, select next available
			if (fromStation.value === this.value) {
				const nextOption = Array.from(fromStation.options).find(opt => !opt.disabled);
				if (nextOption) fromStation.value = nextOption.value;
			}
		});

		// Handle form submission
		form.addEventListener('submit', function(e) {
			e.preventDefault();

			const fromCity = fromStation.value;
			const toCity = toStation.value;
			// Get inputs from within this form to avoid duplicate ID conflicts
			const checkInInput = form.querySelector('input[name="checkInDate"]');
			const checkOutInput = form.querySelector('input[name="checkOutDate"]');
			const adultsInput = form.querySelector('input[name="adults"]');

			// Get dates - assuming format from datepicker, convert to YYYY-MM-DD
			let departDate = checkInInput.value;
			let returnDate = checkOutInput.value;

			// Try to parse and format dates if they exist
			if (departDate) {
				// If using moment.js (already included in theme)
				if (typeof moment !== 'undefined') {
					const parsed = moment(departDate, ['DD/MM/YYYY', 'MM/DD/YYYY', 'YYYY-MM-DD']);
					if (parsed.isValid()) {
						departDate = parsed.format('YYYY-MM-DD');
					}
				}
			} else {
				// Default to today
				departDate = new Date().toISOString().split('T')[0];
			}

			if (returnDate) {
				if (typeof moment !== 'undefined') {
					const parsed = moment(returnDate, ['DD/MM/YYYY', 'MM/DD/YYYY', 'YYYY-MM-DD']);
					if (parsed.isValid()) {
						returnDate = parsed.format('YYYY-MM-DD');
					}
				}
			} else {
				// Default to tomorrow
				const tomorrow = new Date();
				tomorrow.setDate(tomorrow.getDate() + 1);
				returnDate = tomorrow.toISOString().split('T')[0];
			}

			const passengers = adultsInput.value || 1;

			// Build URL
			const params = new URLSearchParams({
				'quick-recommendation': '0',
				'trip': 'roundtrip',
				'fromCity': fromCity,
				'toCity': toCity,
				'depart': departDate,
				'return': returnDate,
				'passengers': passengers
			});

			const bookingUrl = 'https://booking.tonkinheritage.com/add-booking/?' + params.toString();
			
			// Redirect to booking page
			window.location.href = bookingUrl;
		});

		// Initialize disabled options on page load
		updateDisabledOptions();
	});
})();
</script>