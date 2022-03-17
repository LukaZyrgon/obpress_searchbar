<form type="POST" action="/chain-results">
    <div class="ob-searchbar obpress-hotel-searchbar-custom container" id="index" data-hotel-folders="<?php echo htmlspecialchars(json_encode($hotelFolders), ENT_QUOTES, 'UTF-8'); ?>">
        <div class="ob-searchbar-hotel">
            <p>
            <?php
                printf(
                    _n(
                        'Hotel',
                        'Destination or Hotel',
                        $counter_for_hotel,
                        'OBPress_SearchBarPlugin'
                    ),
                    number_format_i18n( $counter_for_hotel )
                );                
            ?>
            </p>
            <input type="text" value="" placeholder="<?php
             if (empty(get_option('hotel_id'))) { 
                    _e('All Hotels', 'OBPress_SearchBarPlugin');
                } 
                ?>" 
            id="hotels" class="<?php
            if (!empty(get_option('hotel_id'))) {
                echo 'single-hotel';
            } ?>" spellcheck="false" autocomplete="off" readonly>

            <input type="hidden" name="c" value="<?php echo get_option('chain_id') ?>">
            <input type="hidden" name="q" id="hotel_code" value="<?php echo ($_GET['q'] ?? '') ?>">
            <input type="hidden" name="currencyId" value="<?= (isset($_GET['currencyId'])) ? $_GET['currencyId'] : get_option('default_currency_id') ?>">
            <input type="hidden" name="lang" value="<?= (isset($_GET['lang'])) ? $_GET['lang'] : get_option('default_language_id') ?>">
            <input type="hidden" name="hotel_folder" id="hotel_folder">
            <input type="hidden" name="NRooms" id="NRooms" value="<?php echo $_GET['NRooms'] ?>">
            <div class="hotels_dropdown">
                <div class="obpress-mobile-close-hotels-dropdown-holder">
                    <span><?php _e('Select destination or hotel', 'OBPress_SearchBarPlugin') ?></span>
                    <img src="<?= get_template_directory_uri() ?>/templates/assets/icons/cross_medium.svg" alt="">
                </div>
                <div class="obpress-mobile-search-hotels-input-holder">
                    <input class="obpress-mobile-search-hotels-input" type="text" placeholder="<?php _e('Enter hotel name or city', 'OBPress_SearchBarPlugin') ?>" id="search-hotels-input">
                </div>
                <div class="hotels_all custom-bg custom-text" data-id="0"><?php _e('All Hotels', 'OBPress_SearchBarPlugin'); ?></div>
                <div class="hotels_folder custom-bg custom-text" hidden></div>
                <div class="hotels_hotel custom-bg custom-text" data-id="" hidden></div>
            </div>
        </div>
        <div class="ob-searchbar-calendar">
            <p><?php _e('Dates of stay', 'OBPress_SearchBarPlugin'); ?></p>
            <input class="calendarToggle" type="text" id="calendar_dates" value="<?php echo $CheckInShow ?? date("d/m/Y") ?> - <?php echo $CheckOutShow ?? date("d/m/Y", strtotime("+1 day")) ?>"  readonly>
            <div class="ob-mobile-searchbar-calendar-holder">
                <div class="ob-mobile-searchbar-calendar">
                    <p><?php _e('Check-in', 'OBPress_SearchBarPlugin'); ?></p>
                    <input class="calendarToggle" type="text" id="check_in_mobile" value="<?php echo $CheckInShowMobile ?? date("d M Y") ?>"  readonly>
                </div>
                <div class="ob-mobile-searchbar-calendar">
                    <p><?php _e('Check-out', 'OBPress_SearchBarPlugin'); ?></p>
                    <input class="calendarToggle" type="text" id="check_out_mobile" value="<?php echo $CheckOutShowMobile ?? date("d M Y", strtotime("+1 day")) ?>"  readonly>
                </div>
            </div>
            <input class="calendarToggle" type="hidden" id="date_from" name="CheckIn" value="<?php echo $CheckIn ?? date("dmY") ?>">
            <input class="calendarToggle" type="hidden" id="date_to" name="CheckOut" value="<?php echo $CheckOut ?? date("dmy", strtotime("+1 day")) ?>">            
        </div>
        <div class="ob-searchbar-guests">
            <p><?php _e('Rooms and guests', 'OBPress_SearchBarPlugin'); ?></p>
            <input type="text" id="guests" data-room="<?php _e('Room', 'OBPress_SearchBarPlugin'); ?>" data-rooms="<?php _e('Rooms', 'OBPress_SearchBarPlugin'); ?>" data-guest="<?php _e('Guest', 'OBPress_SearchBarPlugin'); ?>" data-guests="<?php _e('Guests', 'OBPress_SearchBarPlugin'); ?>" data-remove-room="<?php _e('Remove room', 'OBPress_SearchBarPlugin'); ?>" readonly>
            <input type="hidden" id="ad" name="ad" value="<?= get_option('calendar_adults') ?>">
            <input type="hidden" id="ch" name="ch" value="">
            <input type="hidden" id="ag" name="ag" value="">

            <div id="occupancy_dropdown" class="position-absolute custom-bg custom-text" data-default-currency="<?= (isset($_GET['currencyId'])) ? $_GET['currencyId'] : get_option('default_currency_id') ?>">
                <div class="add-room-holder">
                    <p class="add-room-title select-room-title custom-text"><?php _e('NUMBER OF ROOMS', 'OBPress_SearchBarPlugin') ?></p>
                    <div class="select-room-buttons">
                        <button class="select-button select-button-minus select-room-minus" type="button" disabled>
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line>
                             </svg>
                        </button>
                        <span class="select-value select-room-value">1</span>
                        <button class="select-button select-button-plus select-room-plus" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </button>
                    </div>
                </div>
                <div class="select-room-holder">
                    <div class="select-room" data-room-counter="0">
                        <p class="select-room-title custom-text"><?php _e('Room', 'OBPress_SearchBarPlugin');?> <span class="select-room-counter">1</span></p>
                        <div class="remove-room-mobile"><?php _e('Remove room', 'OBPress_SearchBarPlugin'); ?></div>
                        <div class="select-guests-holder">
                            <div class="select-adults-holder">
                                <div class="select-adults-title">
                                    <img src="<?= get_template_directory_uri() ?>/templates/assets/icons/adults.svg" alt="">
                                    <?php _e('Adults', 'OBPress_SearchBarPlugin'); ?>
                                </div>
                                <div class="select-adults-buttons">
                                    <button class="select-button select-button-minus select-adult-minus" type="button" disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </button>
                                    <span class="select-value select-adults-value">1</span>
                                    <button class="select-button select-button-plus select-adult-plus" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="select-child-holder">
                                <div class="select-child-title">
                                    <img src="<?= get_template_directory_uri() ?>/templates/assets/icons/children.svg" alt="">
                                    <div>
                                        <span><?php _e('Children', 'OBPress_SearchBarPlugin') ?></span>
                                        <span class="select-child-title-max-age">
                                            0 <?php 
                                            _e('to the', 'OBPress_SearchBarPlugin') ; 
                                            echo " " ; 
                                            ?>
                                            <span class='child-max-age'> <?php echo $childrenMaxAge ; ?> </span>
                                        </span> 
                                    </div>
                                </div>
                                <div class="select-child-buttons">
                                    <button class="select-button select-button-minus select-child-minus" type="button" disabled>
                                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </button>
                                    <span class="select-value select-child-value">0</span>
                                    <button class="select-button select-button-plus select-child-plus" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="select-child-ages-holder">
                                <div class="select-child-ages-clone">
                                    <p class="select-child-ages-title custom-text"><?php _e('Age', 'OBPress_SearchBarPlugin'); ?> <span class="select-child-ages-number"></span></p>
                                    <div class="age-picker"> 
                                        <span class="age-picker-value">0</span> 
                                        <div class="age-picker-options">
                                            <?php for ($i = 0; $i < 18; $i++) : ?>
                                                 <div data-age="<?= $i; ?>"> <?= $i; ?> <?php _e('years old', 'OBPress_SearchBarPlugin'); ?></div>
                                            <?php endfor; ?>
                                        </div>
                                    </div>

                                    <select class="select-child-ages-input-clone">
                                        <?php for ($i = 0; $i < 18; $i++) : ?>
                                            <option data-value="<?= $i; ?>" <?php if ($i == 0) { echo "selected";} ?>><?= $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <div class="child-ages-input"></div>
                                    <p class="incorect-age custom-text"><?php _e('Incorrect Age', 'OBPress_SearchBarPlugin') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="add-room-mobile">+ <?php _e('Add another room', 'OBPress_SearchBarPlugin'); ?></div>
                    </div>
                </div>
                <button class="btn-ic custom-action-bg custom-action-border custom-action-text select-occupancy-apply" type="button">
                        <?php _e('Apply', 'OBPress_SearchBarPlugin') ?>
                        <span class="select-occupancy-apply-info">
                                <span class="select-occupancy-apply-info-rooms" data-rooms="1">1</span>
                                <span class="select-occupancy-apply-info-rooms-string"><?php _e('Room', 'OBPress_SearchBarPlugin'); ?></span>
                                ,
                                <span class="select-occupancy-apply-info-guests" data-guests="<?= get_option('calendar_adults') ?>"><?= get_option('calendar_adults') ?></span>
                                <span class="select-occupancy-apply-info-guests-string"><?php _e('Guest', 'OBPress_SearchBarPlugin'); ?></span>
                        </span>
                </button>

            </div>
        </div>
            <div class="ob-searchbar-promo">
                <p><?php _e('I have a code', 'OBPress_SearchBarPlugin'); ?></p>
                <input type="text" id="promo_code" value="" placeholder="<?php _e('Choose type', 'OBPress_SearchBarPlugin'); ?>" readonly>
                <div class="material-check custom-checkbox-holde ob-mobile-i-have-a-code">
                    <div class="mdc-touch-target-wrapper">
                        <div class="mdc-checkbox mdc-checkbox--touch">
                            <input class="board_check mdc-checkbox__native-control checkbox-custom checkbox-custom ob-mobile-i-have-a-code-input" type="checkbox" name="1" id="i_have_a_code">
                            <div class="mdc-checkbox__background">
                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                </svg>
                                <div class="mdc-checkbox__mixedmark"></div>
                            </div>
                        </div>
                    </div>
                    <label class="form-check-label" for="i_have_a_code">
                        <span class="checkbox-custom-label"><?php _e('I HAVE A CODE', 'OBPress_SearchBarPlugin'); ?></span>
                    </label>
                </div>
                <div id="promo_code_dropdown" class="position-absolute custom-bg custom-text">
                    <div class="mb-3 mt-2">
                        <p class="input-title"><?php _e('GROUP CODE', 'OBPress_SearchBarPlugin') ?></p>
                        <div class="material-textfield">
                            <input type="text" id="group_code" name="group_code" placeholder="<?php _e('Enter your code', 'OBPress_SearchBarPlugin'); ?>">
                            <span class="label-title"><?php _e('GROUP CODE', 'OBPress_SearchBarPlugin') ?></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p class="input-title"><?php _e('PROMO CODE', 'OBPress_SearchBarPlugin'); ?></p>
                        <div class="material-textfield">
                            <input type="text" id="Code" name="Code" placeholder="<?php _e('Enter your code', 'OBPress_SearchBarPlugin'); ?>">
                            <span class="label-title"><?php _e('PROMO CODE', 'OBPress_SearchBarPlugin'); ?></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p class="input-title"><?php _e('LOYALTY CODE', 'OBPress_SearchBarPlugin') ?></p>
                        <div class="material-textfield">
                            <input type="text" id="loyalty_code" name="loyalty_code" placeholder="<?php _e('Enter your code', 'OBPress_SearchBarPlugin'); ?>">
                            <span class="label-title"><?php _e('LOYALTY CODE', 'OBPress_SearchBarPlugin') ?></span>
                        </div>
                    </div>

                    <div class="text-right">
                        <button id="promo_code_apply" class="custom-action-bg custom-action-text custom-action-border btn-ic"><?php _e('Apply', 'OBPress_SearchBarPlugin'); ?></button>
                    </div>
                </div>
            </div>
            
        <div class="ob-searchbar-button">
            <button class="ob-searchbar-submit" type="submit"><?php _e('Search', 'OBPress_SearchBarPlugin'); ?></button>
        </div>       
    </div>
    <div class="zcalendar-wrap">
        <div class="ob-zcalendar-top">
            <div class="ob-zcalendar-title">
                <?php _e('Select date of stay', 'OBPress_SearchBarPlugin'); ?>
                <img src="<?= get_template_directory_uri() ?>/templates/assets/icons/cross_medium.svg" alt="">
            </div>
            <div class="ob-mobile-weekdays">
                <div>
                    <span><?php _e('sun', 'OBPress_SearchBarPlugin'); ?></span>
                    <span><?php _e('mon', 'OBPress_SearchBarPlugin'); ?></span>
                    <span><?php _e('tue', 'OBPress_SearchBarPlugin'); ?></span>
                    <span><?php _e('wed', 'OBPress_SearchBarPlugin'); ?></span>
                    <span><?php _e('thu', 'OBPress_SearchBarPlugin'); ?></span>
                    <span><?php _e('fri', 'OBPress_SearchBarPlugin'); ?></span>
                    <span><?php _e('sat', 'OBPress_SearchBarPlugin'); ?></span>
                </div>
            </div>
        </div>
        <div class="zcalendar-holder" id="calendar-holder">
            <div class="zcalendar data-allow-unavail="<?= get_option('allow_unavail_dates') ?> data-allow-unavail="<?= get_option('allow_unavail_dates') ?>" data-promotional="<?php _e('Offers for you', 'OBPress_SearchBarPlugin'); ?>" data-promo="<?php _e('Special Offer', 'OBPress_SearchBarPlugin'); ?>" data-lang="{{$lang->Code}}"  data-night="<?php _e('Night', 'OBPress_SearchBarPlugin') ?>" data-nights="<?php _e('Nights', 'OBPress_SearchBarPlugin') ?>" data-price-for="<?php _e('*Price for', 'OBPress_SearchBarPlugin') ?>" data-adult="<?php _e('adult', 'OBPress_SearchBarPlugin') ?>" data-adults="<?php _e('adults', 'OBPress_SearchBarPlugin') ?>" data-restriction="<?php _e('Restricted Days', 'OBPress_SearchBarPlugin') ?>" data-notavailable="<?php _e('index_no_availability_v4', 'OBPress_SearchBarPlugin') ?>" data-closedonarrival="<?php _e('calendar_closed_on_arrival', 'OBPress_SearchBarPlugin') ?>"  data-closedondeparture="<?php _e('calendar_closed_on_departure', 'OBPress_SearchBarPlugin') ?>" data-minimum-string="<?php _e('system_min', 'OBPress_SearchBarPlugin') ?>" data-maximum-string="<?php _e('system_max', 'OBPress_SearchBarPlugin') ?>" ></div>
        </div>

        <div class="ob-zcalendar-bottom">
            <div> <span class='mobile-accept-dates-from-to'>Seg, 14 Nov - Sex, 18 Nov</span> <span class="number_of_nights-mobile-span"> ( <span class="number_of_nights-mobile"> 4 <?php _e('Nights', 'OBPress_SearchBarPlugin'); ?></span> )</span> </div>
            <div id="mobile-accept-date"> <?php _e('Apply', 'OBPress_SearchBarPlugin'); ?> </div>
        </div>
    </div>     

</form>