<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kmar
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php the_field( 'script_head', 'option' ); ?>
	<?php wp_head(); ?>
	<?php if ( get_field( 'script_css', 'option' ) )
	{ ?>
		<style>
			<?php the_field( 'script_css', 'option' ); ?>
		</style>
	<?php } ?>
	<?php
	if ( get_field( 'script_header', 'option' ) )
	{
		the_field( 'script_header', 'option' );
	}
	?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>


	<header id="header_wrapper" role="banner">
		<div id="header">
			<div id="header_container" class="container-large">
				<div class="left-section box">
					<div class="open_menu_mobile_container">
						<a class="open_menu_mobile" href="javascript:;" title="Open mobile menu"
							aria-label="Open mobile menu"></a>
					</div>
					<div class="hotel-group d-none" role="navigation">
						<a class="logo-group d-flex align-items-center py-2"
							href="<?php echo get_home_url() ?>">
							<?php if ( get_field( 'header_menu_icon_white', 'option' ) ) : ?>
								<?php echo wp_get_attachment_image( get_field( 'header_menu_icon_white', 'option' ), 'full', '', array( 'class' => 'group-logo-white' ) ) ?>
							<?php endif; ?>
							<?php if ( get_field( 'header_menu_icon_black', 'option' ) ) : ?>
								<?php echo wp_get_attachment_image( get_field( 'header_menu_icon_black', 'option' ), 'full', '', array( 'class' => 'group-logo-dark' ) ) ?>
							<?php endif; ?>
							<span class="dropdown"></span>
						</a>
						<div class="hotel-group-nav">
							<div class="menu-top-menu-en-container">
								<ul id="menu-top-menu-en" class="menu">
									<?php
									wp_nav_menu( array(
										'theme_location' => 'menu-2',
										'container' => '__return_false',
										'fallback_cb' => '__return_false',
										'items_wrap' => '%3$s',
										'depth' => 2,

									) );
									?>
								</ul>
							</div>
						</div>
					</div>

					<div class="header_booking_contacts">
						<div class="container_header_contacts">

							<?php
							$phone = get_field( 'header_top_phone', 'option' );
							if ( $phone['title'] ) : ?>
								<div class="be_phone d-flex align-items-center">
									<?php echo svg( 'phone', '16', '16' ) ?>
									<a href="tel:<?php echo $phone['link']; ?>" class="phone">
										<?php echo $phone['title']; ?>
									</a>
								</div>
							<?php endif; ?>
							<?php
							$email = get_field( 'header_top_email', 'option' );
							if ( $email['title'] ) : ?>
								<div class="be_email d-flex align-items-center">
									<?php echo svg( 'email', '16', '16' ) ?>
									<a href="mailto:<?php echo $email['link']; ?>" class="email">
										<?php echo $email['title']; ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="center-section hotel_logo box" role="banner">
					<a class="logo d-block" href="<?php echo get_home_url() ?>" title="Back to homepage"
						aria-label="Back to homepage">
						<?php if ( get_field( 'main_logo_white', 'option' ) ) : ?>
							<?php echo wp_get_attachment_image( get_field( 'main_logo_white', 'option' ), 'full', '', array( 'class' => 'default-logo white' ) ) ?>
						<?php endif; ?>
						<?php if ( get_field( 'main_logo_black', 'option' ) ) : ?>
							<?php echo wp_get_attachment_image( get_field( 'main_logo_black', 'option' ), 'full', '', array( 'class' => 'default-logo dark-blue' ) ) ?>
						<?php endif; ?>
					</a>

				</div>
				<div class="right-section box">

					<div class="language_selector" role="navigation" aria-label="Language menu">
						<a class="current_language" href="javascript:;" hreflang="en"
							aria-label="English">
							<?php echo pll_current_language(); ?>
							<span class="dropdown"></span>
						</a>
						<ul class="other_languages">
							<?php pll_the_languages( array( 'show_flags' => 0, 'show_names' => 0, 'display_names_as' => 'slug' ) ); ?>
						</ul>
					</div>
					<?php
					$book_btn = get_field( 'header_btn_book', 'option' );
					if ( $book_btn['title'] ) : ?>
						<a id="book_now" href="<?php echo check_link( $book_btn['link'] ) ?>"
							class="email">
							<?php echo $book_btn['title']; ?>
						</a>

					<?php endif; ?>

				</div>
			</div>
			<div id="header_menu_container">
				<div class="container-large">
					<nav class="menu-train-menu-en-container">
						<ul id="menu-train-menu-en" class="menu">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'container' => '__return_false',
								'fallback_cb' => '__return_false',
								'items_wrap' => '%3$s',
								'depth' => 2,

							) );
							?>
						</ul>
					</nav>
				</div>
			</div>

		</div>
	</header>

	<div id="menu_sidebar_wrap" class="">
		<a class="close_sidebar overlay" href="javascript:;" aria-label="Close sidebar menu"></a>
		<div class="popin-mobile-menu-wrapper">


			<div class="container_menu_mobile">
				<a class="close" href="javascript:;" title="Close mobile menu"
					aria-label="Close mobile menu"></a>

				<div class="center-section hotel_logo box" role="banner">
					<a class="logo" href="<?php echo get_home_url() ?>" title="Back to homepage"
						aria-label="Back to homepage">
						<?php if ( get_field( 'main_logo_white', 'option' ) ) : ?>
							<?php echo wp_get_attachment_image( get_field( 'main_logo_white', 'option' ), 'full', '', array( 'class' => 'default-logo white' ) ) ?>
						<?php endif; ?>
					</a>
				</div>
			</div>
			<div class="popin-mobile-menu-content">
				<nav class="menu-train-menu-en-container">
					<ul id="menu-train-menu-en-1" class="menu">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'container' => '__return_false',
							'fallback_cb' => '__return_false',
							'items_wrap' => '%3$s',
							'depth' => 2,

						) );
						?>
					</ul>
				</nav>
				<div class="at_bottom">
					<div class="sidebar_booking_contacts">
						<div class="container_sidebar_contacts">

							<?php
							$button = get_field( 'manager_booking', 'option' );
							if ( $button['title'] ) : ?>
								<a class="manage-booking" target="_blank"
									href="<?php echo $button['link']; ?>">
									<?php echo $button['title']; ?>
								</a>
							<?php endif; ?>



							<?php
							$phone = get_field( 'header_top_phone', 'option' );
							if ( $phone['title'] ) : ?>
								<div class="be_phone">
									<span class="no_wrap">
										<?php echo svg( 'phone', '16', '16' ) ?>
										&nbsp;
										<?php _e( 'Contact us:', 'kmar' ) ?>
									</span>
									<a href="tel:<?php echo $phone['link']; ?>"
										class="phone ms-4 mt-2 w-100">
										<?php echo $phone['title']; ?>
									</a>
								</div>
							<?php endif; ?>



						</div>
					</div>
					<div class="languages">
                    <?php
                        $languages = pll_the_languages(array('raw' => 1));
                        if (!empty($languages)) : ?>
                            <div id="mobile_languages">
                                <select onchange="if (this.value) window.location.href=this.value">
                                    <?php foreach ($languages as $lang) : ?>
                                        <option value="<?php echo esc_url($lang['url']); ?>"
                                                data-language="<?php echo esc_attr($lang['name']); ?>"
                                                <?php echo $lang['current_lang'] ? 'selected="selected"' : ''; ?>>
                                            <?php echo esc_html($lang['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>

					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="bookingform_sidebar_wrap">
		<div id="bookingform_sidebar_dialog" class="bookingform_sidebar" role="dialog"
			aria-modal="true" aria-label="Book your trip">
			<a class="close_sidebar_bookingform" href="javascript:;" aria-hidden="false"
				title="Close the sidebar bookingform"
				aria-label="Close the sidebar with the bookingform">
				<span class="sr-only">Close the sidebar bookingform</span>
			</a>
			<div class="bookingform_sidebar_inner_content">
				<div class="the-title">Book your itinerary</div>
				<div class="bookingform_vertical">

					<!-- START bookingform -->
					<div class="bookingform_wrapper">
						<form class="bookingform" method="post">
							<fieldset class="fieldset">
								<legend>Choose your dates</legend>


								<!-- TODO <div class="form_row country_selection"></div>-->

								<div class="form_row train_selection">
									<div class="input_wrap">
										<label>
											<span class="label">Trains</span>
											<select
												class="train_selector disabled_during_api_request"
												name="train_selector" autocomplete="off"
												tabindex="-1">
												<option
													value="https://www.orient-express.com/hidden-prod-ldv2024"
													role="button">HIDDEN PROD LDV 2024</option>
												<option
													value="https://www.orient-express.com/new-orient-express"
													role="button">New Orient Express</option>
												<option selected="" value="13" role="button">La
													Dolce Vita</option>
											</select>
										</label>
									</div>
								</div>
								<div class="form_row itinerary_selection">
									<div class="input_wrap">
										<label>
											<span class="label">Itineraries</span>
											<select
												class="itinerary_selector disabled_during_api_request"
												name="itinerary_selector" autocomplete="off"
												tabindex="-1">
												<option selected="selected"
													value="7,8,10,9,6,24,25,26" role="button">See
													all the itineraries</option>
												<optgroup label="from Rome">
													<option value="7" data-page-id="401453"
														role="button">Venice and Portofino</option>
													<option value="8" data-page-id="401586"
														role="button">Venice and Tuscany</option>
													<option value="10" data-page-id="401651"
														role="button">Eternal Stones of Matera
													</option>
													<option value="9" data-page-id="401659"
														role="button">Tastes of Tuscan Vineyards
													</option>
													<option value="6" data-page-id="401701"
														role="button">The Truffle Route</option>
													<option value="24" data-page-id="401674"
														role="button">From Rome to Sicily</option>
												</optgroup>
												<optgroup label="from Palermo">
													<option value="25" data-page-id="401708"
														role="button">From Sicily to Rome</option>
												</optgroup>
												<optgroup label="from Catania">
													<option value="26" data-page-id="401683"
														role="button">Shores of Sicily</option>
												</optgroup>
											</select>
										</label>
									</div>
								</div>
								<div class="form_row passengers_month_selection">

									<div class="passengers_selection">
										<span class="label">Cabins and passengers</span>
										<div class="input_wrap">
											<div class="passengers_dropdown">
												<span class="placeholder_passengers"><span
														class="cabin_count">1 cabin</span> - <span
														class="passengers_count">1
														passenger</span></span>
												<div class="dropdown_passengers">

													<div
														class="dropdown_row cabins_counter_container">

														<span class="label">
															<span class="label_title">N°
																Cabins</span>
														</span>
														<div
															class="cabin_stepper incrementor_outer">
															<button type="button"
																class="qty-down quantity_decrease"
																aria-label="Remove a cabin from your list"
																title="Remove a cabin from your list"><i
																	class="fa-solid fa-minus"></i></button>
															<label>
																<span class="is_hidden">Number of
																	cabins</span>
																<input type="text"
																	class="numberonly increment_placeholder"
																	name="cabin_counter" value="1"
																	max="3" readonly="">
															</label>
															<button type="button"
																class="qty-up quantity_increase"
																aria-label="Add a cabin to your list"
																title="Add a cabin to your list"><i
																	class="fa-solid fa-plus"></i></button>
														</div>
													</div>
													<div class="dropdown_row cabins_list_container">
														<div class="passengers_steppers">

															<div id="row_cabin_1"
																class="wrap cabin_wrap  cabin_1_wrap">
																<div class="inner_wrap">
																	<div
																		class="row_column title_field">
																		<div class="label">Cabin 1
																		</div>
																	</div>
																	<div class="row_column">
																		<div class="adults_field">
																			<span class="label">
																				<span
																					class="label_title"><i
																						class="fa-solid fa-person-simple"></i>
																					Passengers</span>
																			</span>
																			<div class="">
																				<div
																					class="stepper incrementor_outer adults_stepper cabin_1_adults_field">
																					<button
																						type="button"
																						class="cabin_1_qty_down quantity_decrease"
																						aria-label="Remove an adult from the cabin 1"
																						title="Remove an adult from the cabin 1"><i
																							class="fa-solid fa-minus"></i></button>
																					<label>
																						<span
																							class="is_hidden">Number
																							of
																							adults
																							per
																							cabin
																							1</span>
																						<input
																							type="text"
																							class="numberonly cabin_1increment_placeholder increment_placeholder"
																							name="adults[0]"
																							value="1"
																							data-max="3"
																							readonly="">
																					</label>
																					<button
																						type="button"
																						class="cabin_1_qty_up quantity_increase"
																						aria-label="Add an adult in the cabin 1"
																						title="Add an adult in the cabin 1"><i
																							class="fa-solid fa-plus"></i></button>
																				</div>
																			</div>
																		</div>
																		<div class="children_field"
																			style="display: none">
																			<span class="label">
																				<span
																					class="label_title">Children</span>
																				<span
																					class="label_subtitle">(
																					< 12 years old
																						)</span>
																				</span>
																				<div class="">
																					<div
																						class="stepper incrementor_outer children_stepper cabin_1_children_field">
																						<button
																							type="button"
																							class="cabin_1_qty_down quantity_decrease"
																							aria-label="Remove a child from the cabin 1"
																							title="Remove a child from the cabin 1"><i
																								class="fa-solid fa-minus"></i></button>
																						<label>
																							<span
																								class="is_hidden">Number
																								of
																								children
																								for
																								cabin
																								1</span>
																							<input
																								type="text"
																								class="numberonly cabin_1increment_placeholder increment_placeholder"
																								name="children[0]"
																								value="0"
																								max="3"
																								readonly="">
																						</label>
																						<button
																							type="button"
																							class="cabin_1_qty_up quantity_increase"
																							aria-label="Add a child in the cabin 1"
																							title="Add a child in the cabin 1"><i
																								class="fa-solid fa-plus"></i></button>
																					</div>
																				</div>
																		</div>
																		<!--<div class="infants_field">
											<span class="label">
												<span class="label_title"></span>
												<span class="label_subtitle">( < )</span>
											</span>
											<div class="tooltip">
												<span class="tooltip_badge">?</span>
												<span class="tooltiptext">Sem tortor enim lacus molestie vel erat facilisis enim eros gravida amet massa accumsan rutrum.</span>
											</div>
										</div>-->
																	</div>

																</div>
															</div>


															<div id="row_cabin_2"
																class="wrap cabin_wrap hidden cabin_2_wrap">
																<div class="inner_wrap">
																	<div
																		class="row_column title_field">
																		<div class="label">Cabin 2
																		</div>
																	</div>
																	<div class="row_column">
																		<div class="adults_field">
																			<span class="label">
																				<span
																					class="label_title"><i
																						class="fa-solid fa-person-simple"></i>
																					Passengers</span>
																			</span>
																			<div class="">
																				<div
																					class="stepper incrementor_outer adults_stepper cabin_2_adults_field">
																					<button
																						type="button"
																						class="cabin_2_qty_down quantity_decrease"
																						aria-label="Remove an adult from the cabin 2"
																						title="Remove an adult from the cabin 2"><i
																							class="fa-solid fa-minus"></i></button>
																					<label>
																						<span
																							class="is_hidden">Number
																							of
																							adults
																							per
																							cabin
																							2</span>
																						<input
																							type="text"
																							class="numberonly cabin_2increment_placeholder increment_placeholder"
																							name="adults[1]"
																							value="1"
																							data-max="3"
																							readonly="">
																					</label>
																					<button
																						type="button"
																						class="cabin_2_qty_up quantity_increase"
																						aria-label="Add an adult in the cabin 2"
																						title="Add an adult in the cabin 2"><i
																							class="fa-solid fa-plus"></i></button>
																				</div>
																			</div>
																		</div>
																		<div class="children_field"
																			style="display: none">
																			<span class="label">
																				<span
																					class="label_title">Children</span>
																				<span
																					class="label_subtitle">(
																					< 12 years old
																						)</span>
																				</span>
																				<div class="">
																					<div
																						class="stepper incrementor_outer children_stepper cabin_2_children_field">
																						<button
																							type="button"
																							class="cabin_2_qty_down quantity_decrease"
																							aria-label="Remove a child from the cabin 2"
																							title="Remove a child from the cabin 2"><i
																								class="fa-solid fa-minus"></i></button>
																						<label>
																							<span
																								class="is_hidden">Number
																								of
																								children
																								for
																								cabin
																								2</span>
																							<input
																								type="text"
																								class="numberonly cabin_2increment_placeholder increment_placeholder"
																								name="children[1]"
																								value="0"
																								max="3"
																								readonly="">
																						</label>
																						<button
																							type="button"
																							class="cabin_2_qty_up quantity_increase"
																							aria-label="Add a child in the cabin 2"
																							title="Add a child in the cabin 2"><i
																								class="fa-solid fa-plus"></i></button>
																					</div>
																				</div>
																		</div>
																		<!--<div class="infants_field">
											<span class="label">
												<span class="label_title"></span>
												<span class="label_subtitle">( < )</span>
											</span>
											<div class="tooltip">
												<span class="tooltip_badge">?</span>
												<span class="tooltiptext">Sem tortor enim lacus molestie vel erat facilisis enim eros gravida amet massa accumsan rutrum.</span>
											</div>
										</div>-->
																	</div>

																</div>
															</div>


															<div id="row_cabin_3"
																class="wrap cabin_wrap hidden cabin_3_wrap">
																<div class="inner_wrap">
																	<div
																		class="row_column title_field">
																		<div class="label">Cabin 3
																		</div>
																	</div>
																	<div class="row_column">
																		<div class="adults_field">
																			<span class="label">
																				<span
																					class="label_title"><i
																						class="fa-solid fa-person-simple"></i>
																					Passengers</span>
																			</span>
																			<div class="">
																				<div
																					class="stepper incrementor_outer adults_stepper cabin_3_adults_field">
																					<button
																						type="button"
																						class="cabin_3_qty_down quantity_decrease"
																						aria-label="Remove an adult from the cabin 3"
																						title="Remove an adult from the cabin 3"><i
																							class="fa-solid fa-minus"></i></button>
																					<label>
																						<span
																							class="is_hidden">Number
																							of
																							adults
																							per
																							cabin
																							3</span>
																						<input
																							type="text"
																							class="numberonly cabin_3increment_placeholder increment_placeholder"
																							name="adults[2]"
																							value="1"
																							data-max="3"
																							readonly="">
																					</label>
																					<button
																						type="button"
																						class="cabin_3_qty_up quantity_increase"
																						aria-label="Add an adult in the cabin 3"
																						title="Add an adult in the cabin 3"><i
																							class="fa-solid fa-plus"></i></button>
																				</div>
																			</div>
																		</div>
																		<div class="children_field"
																			style="display: none">
																			<span class="label">
																				<span
																					class="label_title">Children</span>
																				<span
																					class="label_subtitle">(
																					< 12 years old
																						)</span>
																				</span>
																				<div class="">
																					<div
																						class="stepper incrementor_outer children_stepper cabin_3_children_field">
																						<button
																							type="button"
																							class="cabin_3_qty_down quantity_decrease"
																							aria-label="Remove a child from the cabin 3"
																							title="Remove a child from the cabin 3"><i
																								class="fa-solid fa-minus"></i></button>
																						<label>
																							<span
																								class="is_hidden">Number
																								of
																								children
																								for
																								cabin
																								3</span>
																							<input
																								type="text"
																								class="numberonly cabin_3increment_placeholder increment_placeholder"
																								name="children[2]"
																								value="0"
																								max="3"
																								readonly="">
																						</label>
																						<button
																							type="button"
																							class="cabin_3_qty_up quantity_increase"
																							aria-label="Add a child in the cabin 3"
																							title="Add a child in the cabin 3"><i
																								class="fa-solid fa-plus"></i></button>
																					</div>
																				</div>
																		</div>
																		<!--<div class="infants_field">
											<span class="label">
												<span class="label_title"></span>
												<span class="label_subtitle">( < )</span>
											</span>
											<div class="tooltip">
												<span class="tooltip_badge">?</span>
												<span class="tooltiptext">Sem tortor enim lacus molestie vel erat facilisis enim eros gravida amet massa accumsan rutrum.</span>
											</div>
										</div>-->
																	</div>

																</div>
															</div>



															<div class="confirm_field">
																<div
																	class="buttons_container vertical">
																	<a href="javascript:;"
																		id="confirm_occupancy"
																		aria-label="Confirm cabin occupancy"
																		title="Confirm occupancy"
																		class="button only_border confirm_occupancy">Confirm</a>
																</div>
															</div>
														</div>
													</div>


												</div>
											</div>
										</div>
									</div>
									<div class="month_selection">
										<div class="input_wrap">
											<label>
												<span class="label">Departure month</span>
												<select
													class="month_departure_selector disabled_during_api_request"
													name="month_departure_selector"
													autocomplete="off" tabindex="-1">
													<option selected="" class="no_disable" value=""
														role="button">Anytime</option>
													<option value="2025-02" role="button">February
														2025</option>
													<option value="2025-03" role="button">March 2025
													</option>
													<option value="2025-04" role="button">April 2025
													</option>
													<option value="2025-05" role="button">May 2025
													</option>
													<option value="2025-06" role="button">June 2025
													</option>
													<option value="2025-07" role="button">July 2025
													</option>
													<option value="2025-08" role="button">August
														2025</option>
													<option value="2025-09" role="button">September
														2025</option>
													<option value="2025-10" role="button">October
														2025</option>
													<option value="2025-11" role="button">November
														2025</option>
													<option value="2025-12" role="button">December
														2025</option>
													<option value="2026-01" role="button">January
														2026</option>
													<option value="2026-02" role="button">February
														2026</option>
													<option value="2026-03" role="button">March 2026
													</option>
													<option value="2026-04" role="button">April 2026
													</option>
													<option value="2026-05" role="button">May 2026
													</option>
													<option value="2026-06" role="button">June 2026
													</option>
													<option value="2026-07" role="button">July 2026
													</option>
													<option value="2026-08" role="button">August
														2026</option>
													<option value="2026-09" role="button">September
														2026</option>
													<option value="2026-10" role="button">October
														2026</option>
													<option value="2026-11" role="button">November
														2026</option>
													<option value="2026-12" role="button">December
														2026</option>
													<option value="2027-01" role="button">January
														2027</option>
													<option value="2027-02" role="button">February
														2027</option>
													<option value="2027-03" role="button">March 2027
													</option>
												</select>
											</label>
										</div>
									</div>

								</div>

								<div class="form_row error_search_container">
									<div class="error_container">
										<span class="error"></span>
									</div>
								</div>

								<div class="form_row submit_wrap">
									<div class="inner_wrap">
										<input type="submit" class="disabled_during_api_request"
											value="Search" title="Start search"
											aria-label="Start search">
									</div>
								</div>

							</fieldset>
						</form>
					</div>
					<!-- END bookingform-->

				</div>
			</div>
		</div>
	</div>


	<div id="loader_css" class="box">
		<div class="center_logo_icon">
			<div class="center-section hotel_logo box" role="banner">
				<a class="logo hide_mobile" href="<?php echo get_home_url() ?>"
					title="Back to homepage" aria-label="Back to homepage">
					<?php if ( get_field( 'main_logo_white', 'option' ) ) : ?>
						<?php echo wp_get_attachment_image( get_field( 'main_logo_white', 'option' ), 'full', '', array( 'class' => 'default-logo white' ) ) ?>
					<?php endif; ?>

				</a>
				<a class="logo only_mobile" href="<?php echo get_home_url() ?>"
					title="Back to homepage" aria-label="Back to homepage">
					<?php if ( get_field( 'main_logo_white', 'option' ) ) : ?>
						<?php echo wp_get_attachment_image( get_field( 'main_logo_white', 'option' ), 'full', '', array( 'class' => 'default-logo white' ) ) ?>
					<?php endif; ?>

				</a>
			</div>
			<div class="loader-14"></div>
		</div>
	</div>
	<?php
