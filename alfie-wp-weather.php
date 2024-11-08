<?php
/**
 *
 * Alfie WP Weather Widget 1.2.13

 */

function alfie_wp_weather( $options ) {
    // Show the widget items as selected in the admin
    ?>
    <script id="widget-template" type="alfie/appcuarium">
        <div class="alfie-wp-weather-object {{daynight}}">
            <div class="weather-main-info">
                <div class="alfie-wp-weather-item alfie-city">{{city}}</div>
                <?php if ( $options[ 'alfie_wp_weather_country' ] ) { ?>
                    <div class="alfie-wp-weather-item alfie-country">{{country}}</div>
                <?php } ?>
                <div class="alfie-wp-weather-item alfie-temperature"><span>{{currentTemp}}</span>&deg;</div>
                <?php if ( $options[ 'alfie_wp_weather_condition' ] ) { ?>
                    <div class="alfie-wp-weather-item alfie-description">{{condition}}</div>
                <?php } ?>
        <?php if ( $options[ 'alfie_wp_weather_highlow' ] ) { ?>
                    <div class="alfie-wp-weather-item alfie-range"><?php echo __( 'High', 'alfie_wp_weather' ); ?>:&nbsp;{{high}}&deg;&nbsp;<?php echo __( 'Low', 'alfie_wp_weather' ); ?>:&nbsp;{{low}}&deg;</div>
                <?php } ?>
        <?php if ( $options[ 'alfie_wp_weather_wind' ] ) { ?>
                    <div class="alfie-wp-weather-item alfie-wind"><?php echo __( 'Wind', 'alfie_wp_weather' ); ?>:&nbsp;{{wind_direction}}
                        {{wind}} {{speed_unit}}
                    </div>
                <?php } ?>
        <?php if ( $options[ 'alfie_wp_weather_humidity' ] ) { ?>
                    <div class="alfie-wp-weather-item alfie-humidity"><?php echo __( 'Humidity', 'alfie_wp_weather' ); ?>:&nbsp;{{humidity}}&#37;</div>
                <?php } ?>
        <?php if ( $options[ 'alfie_wp_weather_visibility' ] ) { ?>
                    <div class="alfie-wp-weather-item alfie-visibility"><?php echo __( 'Visibility', 'alfie_wp_weather' ); ?>:&nbsp;{{visibility}}</div>
                <?php } ?>
        <?php if ( $options[ 'alfie_wp_weather_sunrise' ] ) { ?>
                    <div class="alfie-wp-weather-item alfie-sunrise"><?php echo __( 'Sunrise', 'alfie_wp_weather' ); ?>:&nbsp;{{sunrise}}</div>
                <?php } ?>
        <?php if ( $options[ 'alfie_wp_weather_sunset' ] ) { ?>
                    <div class="alfie-wp-weather-item alfie-sunset"><?php echo __( 'Sunset', 'alfie_wp_weather' ); ?>:&nbsp;{{sunset}}</div>
                <?php } ?>
            </div>
            <?php if ( $options[ 'alfie_wp_weather_forecast' ] ) { ?>
                <div class="alfie-wp-weather-forecast">
                    <div class="alfie-wp-weather-forecast-item">
                        <div class="alfie-wp-weather-forecast-day">{{day_one}}</div>
                        <?php if ( $options[ 'alfie_wp_weather_forecast_image' ] ) { ?>
                            <img src="http://l.yimg.com/a/i/us/nws/weather/gr/{{forecast_one_code}}s.png"/>
                        <?php } ?>
                        <div class="alfie-wp-weather-forecast-highlow"><?php echo __( 'High', 'alfie_wp_weather' ); ?>
                            :&nbsp;<span>{{forecast_one_high}}&deg;</span></div>
                        <div class="alfie-wp-weather-forecast-highlow"><?php echo __( 'Low', 'alfie_wp_weather' ); ?>:&nbsp;{{forecast_one_low}}&deg;</div>
                    </div>

                    <div class="alfie-wp-weather-forecast-item">
                        <div class="alfie-wp-weather-forecast-day">{{day_two}}</div>
                        <?php if ( $options[ 'alfie_wp_weather_forecast_image' ] ) { ?>
                            <img src="http://l.yimg.com/a/i/us/nws/weather/gr/{{forecast_two_code}}s.png"/>
                        <?php } ?>
                        <div class="alfie-wp-weather-forecast-highlow"><?php echo __( 'High', 'alfie_wp_weather' ); ?>
                            :&nbsp;<span>{{forecast_two_high}}&deg;</span></div>
                        <div class="alfie-wp-weather-forecast-highlow"><?php echo __( 'Low', 'alfie_wp_weather' ); ?>:&nbsp;{{forecast_two_low}}&deg;</div>
                    </div>
                </div>
            <?php } ?>
        <?php if ( $options[ 'alfie_wp_weather_credits' ] ) { ?>
                <div class="alfie-wp-weather-footer">
                    <ul>
                        <li class="alfie-left"><img title="{{yahoo_logo_title}}" src="{{yahoo_logo}}" width="80"></li>
                        <li class="alfie-right">powered by <a href="http://www.appcuarium.com"
                                                        target="_blank"><strong>appcuarium</strong></a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
        <?php if ( $options[ 'alfie_wp_weather_image' ] ) { ?>
            <img class="condition-main-image" src="{{image_bg}}{{daynight}}.png" />
        <?php } ?>
    </script>

    <script>
        (function ( $, window, document, undefined ) {
            $( function () {

                var $me = $( '#woeid-<?php echo $options['woeid']; ?>' ),
                    $body = $( 'body' ),
                    auto_location = '<?php if ( $options['alfie_wp_weather_location'] ) { echo '1'; } else { echo '0'; }; ?>',
                    params = {
                        woeid: <?php echo $options['woeid']; ?>,
                        unit: '<?php echo $options['alfie_wp_weather_temperature']; ?>',
                        image: <?php echo $options['alfie_wp_weather_image']; ?>,
                        country: <?php echo $options['alfie_wp_weather_country']; ?>,
                        highlow: <?php echo $options['alfie_wp_weather_highlow']; ?>,
                        wind: <?php echo $options['alfie_wp_weather_wind']; ?>,
                        humidity: <?php echo $options['alfie_wp_weather_humidity']; ?>,
                        visibility: <?php echo $options['alfie_wp_weather_visibility']; ?>,
                        sunrise: <?php echo $options['alfie_wp_weather_sunrise']; ?>,
                        sunset: <?php echo $options['alfie_wp_weather_sunset']; ?>,
                        forecast: <?php echo $options['alfie_wp_weather_forecast']; ?>,
                        forecast_image: <?php echo $options['alfie_wp_weather_forecast_image']; ?>,
                        locale: '<?php global $sitepress; if ( $sitepress ) { echo ICL_LANGUAGE_CODE; } else {echo get_locale();}?>',
                        timestamp: '<?php echo time();?>',
                        auto_location: parseInt( auto_location ),
                        client_ip: '<?php echo ALFIE_WEATHER_CLIENT_IP;?>'
                    };

                $me.alfie( {
                    action: {
                        get_weather: {
                            params: params
                        }
                    },
                    onComplete: function ( response ) {
                        $me.html( response );
                    }
                } );
            } );
        })( jQuery, window, document );
    </script>
<?php
}

class alfie_wp_weather_widget extends WP_Widget {

    function __construct() {

        $widget_options = array(
            'classname' => 'alfie_wp_weather', 'description' => __( 'Alfie WP Weather widget.', 'alfie_wp_weather' )
        );

        $this->WP_Widget( 'alfie-wp-weather', 'Alfie WP Weather', $widget_options );

        $protocol = 'http';

        $debug = ( ALFIE_WEATHER_DEBUG == true ) ? '' : '.min';

        if ( isset( $_SERVER[ 'HTTPS' ] ) ) {
            if ( strtoupper( $_SERVER[ 'HTTPS' ] ) == 'ON' ) {
                $protocol = 'https';
            }
        }

        if ( !function_exists( 'has_shortcode' ) ) {

            function has_shortcode( $content, $short_code = '' ) {
                $is_short_code = false;

                if ( stripos( $content, '[' . $short_code ) !== false ) {
                    $is_short_code = true;
                }

                return $is_short_code;
            }
        }

        if ( is_active_widget( false, false, $this->id_base ) && !has_shortcode( $post->post_content, 'alfie_wp_weather' ) ) {

            wp_enqueue_style( 'alfie-wp-weather', ALFIE_WEATHER_URL . 'css/widget' . $debug . '.css' );
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'alfie-wp-weather', ALFIE_WEATHER_URL . 'js/alfie.weather' . $debug . '.js' );
            wp_localize_script( 'alfie-wp-weather', 'alfie', array( 'path' => str_replace( $protocol . '://' . $_SERVER[ 'HTTP_HOST' ], '', plugins_url() ) ) );
            wp_enqueue_script( 'alfie-wp-admin', ALFIE_WEATHER_URL . 'js/alfie-weather' . $debug . '.js' );
            wp_localize_script( 'alfie-wp-admin', 'alfie', array( 'path' => str_replace( $protocol . '://' . $_SERVER[ 'HTTP_HOST' ], '', plugins_url() ) ) );

        }
    }

    function widget( $args, $instance ) {
        extract( $args );

        $args = array(

            'woeid' => intval( $instance[ 'woeid' ] ),
            'alfie_wp_weather_location' => ( !empty( $instance[ 'alfie_wp_weather_location' ] ) && $instance[ 'alfie_wp_weather_location' ] == 'automatic_location' ) ? 1 : 0,
            'alfie_wp_weather_image' => !empty( $instance[ 'alfie_wp_weather_image' ] ) ? 1 : 0,
            'alfie_wp_weather_country' => !empty( $instance[ 'alfie_wp_weather_country' ] ) ? 1 : 0,
            'alfie_wp_weather_condition' => !empty( $instance[ 'alfie_wp_weather_condition' ] ) ? 1 : 0,
            'alfie_wp_weather_temperature' => $instance[ 'alfie_wp_weather_temperature' ],
            'alfie_wp_weather_highlow' => !empty( $instance[ 'alfie_wp_weather_highlow' ] ) ? 1 : 0,
            'alfie_wp_weather_wind' => !empty( $instance[ 'alfie_wp_weather_wind' ] ) ? 1 : 0,
            'alfie_wp_weather_humidity' => !empty( $instance[ 'alfie_wp_weather_humidity' ] ) ? 1 : 0,
            'alfie_wp_weather_visibility' => !empty( $instance[ 'alfie_wp_weather_visibility' ] ) ? 1 : 0,
            'alfie_wp_weather_sunrise' => !empty( $instance[ 'alfie_wp_weather_sunrise' ] ) ? 1 : 0,
            'alfie_wp_weather_sunset' => !empty( $instance[ 'alfie_wp_weather_sunset' ] ) ? 1 : 0,
            'alfie_wp_weather_forecast' => !empty( $instance[ 'alfie_wp_weather_forecast' ] ) ? 1 : 0,
            'alfie_wp_weather_forecast_image' => !empty( $instance[ 'alfie_wp_weather_forecast_image' ] ) ? 1 : 0,
            'alfie_wp_weather_credits' => !empty( $instance[ 'alfie_wp_weather_credits' ] ) ? 1 : 0

        );

        echo $before_widget;

        if ( !empty( $instance[ 'title' ] ) ) {
            echo $before_title . apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base ) . $after_title;
        }
        echo '<div id="woeid-' . $args[ 'woeid' ] . '" class="widget-container alfie-container">';
        alfie_wp_weather( $args );
        echo '</div>';
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance = $new_instance;

        $instance[ 'woeid' ] = strip_tags( $new_instance[ 'woeid' ] );
        $instance[ 'alfie_wp_weather_image' ] = ( isset( $new_instance[ 'alfie_wp_weather_location' ] ) && $new_instance[ 'alfie_wp_weather_location' ] == 'automatic_updates' ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_image' ] = ( isset( $new_instance[ 'alfie_wp_weather_image' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_country' ] = ( isset( $new_instance[ 'alfie_wp_weather_country' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_condition' ] = ( isset( $new_instance[ 'alfie_wp_weather_condition' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_temperature' ] = strip_tags( $new_instance[ 'alfie_wp_weather_temperature' ] );
        $instance[ 'alfie_wp_weather_highlow' ] = ( isset( $new_instance[ 'alfie_wp_weather_highlow' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_wind' ] = ( isset( $new_instance[ 'alfie_wp_weather_wind' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_humidity' ] = ( isset( $new_instance[ 'alfie_wp_weather_humidity' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_visibility' ] = ( isset( $new_instance[ 'alfie_wp_weather_visibility' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_sunrise' ] = ( isset( $new_instance[ 'alfie_wp_weather_sunrise' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_sunset' ] = ( isset( $new_instance[ 'alfie_wp_weather_sunset' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_forecast' ] = ( isset( $new_instance[ 'alfie_wp_weather_forecast' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_forecast_image' ] = ( isset( $new_instance[ 'alfie_wp_weather_forecast_image' ] ) ) ? 1 : 0;
        $instance[ 'alfie_wp_weather_credits' ] = ( isset( $new_instance[ 'alfie_wp_weather_credits' ] ) ) ? 1 : 0;

        return $instance;
    }

    /**
     * Set up the widget options in WordPress admin
     * @param array $instance
     * @return string|void
     */
    function form( $instance ) {

        wp_enqueue_style( 'alfie-weather-options', ALFIE_WEATHER_URL . 'css/admin.min.css', false, 0.7, 'screen' );
        wp_enqueue_script( 'alfie-wp-weather_admin', ALFIE_WEATHER_URL . 'js/alfie-weather.min.js' );

        $defaults = array(
            'title' => __( 'Local Weather', 'alfie_wp_weather' ),
            'woeid' => '769293',
            'alfie_wp_weather_location' => false,
            'alfie_wp_weather_image' => true,
            'alfie_wp_weather_country' => true,
            'alfie_wp_weather_condition' => true,
            'alfie_wp_weather_temperature' => 'c',
            'alfie_wp_weather_highlow' => true,
            'alfie_wp_weather_wind' => true,
            'alfie_wp_weather_humidity' => true,
            'alfie_wp_weather_visibility' => true,
            'alfie_wp_weather_sunrise' => true,
            'alfie_wp_weather_sunset' => true,
            'alfie_wp_weather_forecast' => true,
            'alfie_wp_weather_forecast_image' => true,
            'alfie_wp_weather_credits' => true
        );

        $instance = wp_parse_args( (array)$instance, $defaults );
        $temperature = strip_tags( $instance[ 'alfie_wp_weather_temperature' ] );
        $temperature_option = array(
            'c' => __( 'Celsius', 'alfie_wp_weather' ), 'f' => __( 'Fahrenheit', 'alfie_wp_weather' )
        );
        ?>
        <script id="weather-template" type="alfie/appcuarium">
			<li rel="{{woeid}}" class="item city-woeid">
				<a>{{location}} - {{country}}</span>
			</li>
        </script>
        <div class="widget-controls">
            <p class="alfie-location-type">
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Location:', 'alfie_wp_weather_location' ); ?></label><br/>
                <input type="radio" name="<?php echo $this->get_field_name( 'alfie_wp_weather_location' ); ?>" value="manual_location" <?php $checked = checked( 'manual_location', $instance[ 'alfie_wp_weather_location' ], true );
                $checked_auto = checked( 'automatic_location', $instance[ 'alfie_wp_weather_location' ], false );
                if ( $checked == '' && $checked_auto == false ) {
                    echo 'checked="checked"';
                };?> /><span><?php _e( 'Manual', 'alfie_wp_weather' ); ?></span>
                <input type="radio" name="<?php echo $this->get_field_name( 'alfie_wp_weather_location' ); ?>" value="automatic_location" <?php checked( 'automatic_location', $instance[ 'alfie_wp_weather_location' ] ); ?> /><span><?php _e( 'Automatic', 'alfie_wp_weather' ); ?></span>
            </p>

            <div class="alfie-search-box">
                <p>
                    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'alfie_wp_weather' ); ?></label>
                    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                           name="<?php echo $this->get_field_name( 'title' ); ?>"
                           value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" <?php $checked = checked( 'automatic_location', $instance[ 'alfie_wp_weather_location' ], false );
                    if ( $checked == true ) {
                        echo 'readonly="readonly"';
                    };?>/>
                </p>

                <p>
                    <label for="<?php echo $this->get_field_id( 'woeid' ); ?>"><?php _e( 'WOEID:', 'alfie_wp_weather' ); ?></label>
                    <input type="text" class="widefat alfie-woeid" id="<?php echo $this->get_field_id( 'woeid' ); ?>"
                           name="<?php echo $this->get_field_name( 'woeid' ); ?>"
                           value="<?php echo esc_attr( $instance[ 'woeid' ] ); ?>" <?php $checked = checked( 'automatic_location', $instance[ 'alfie_wp_weather_location' ], false );
                    if ( $checked == true ) {
                        echo 'readonly="readonly"';
                    };?>/>
                </p>

                <div id="location-search">
                    <div id="location-input">
                        <label for="<?php echo $this->get_field_id( 'city' ); ?>"><?php _e( 'Search for a location:', 'alfie_wp_weather' ); ?></label>
                        <input autocomplete="off" class="widefat" type="text" id="search-location" name="search-location"/>
                    </div>
                    <a class="search_woeid enabled button button-primary fullwidth aligncenter mb20"><?php _e( 'Click to search location', 'alfie_wp_weather' ); ?></a>

                    <div id="weatherList"></div>
                    <div id="cities"></div>
                </div>
            </div>
            <br/>

            <div class="clear"></div>
            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_temperature' ); ?>"><?php _e( 'Temperature', 'alfie_wp_weather' ) ?></label>
                <select class="smallfat" id="<?php echo $this->get_field_id( 'alfie_wp_weather_temperature' ); ?>"
                        name="<?php echo $this->get_field_name( 'alfie_wp_weather_temperature' ); ?>">
                    <?php foreach ( $temperature_option as $dataype => $option_label ) { ?>
                        <option
                            value="<?php echo esc_attr( $dataype ); ?>" <?php selected( $temperature, $dataype ); ?>><?php echo esc_html( $option_label ); ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_image' ); ?>"> <input class="checkbox"
                                                                                                    type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_image' ], true ); ?>
                                                                                                    id="<?php echo $this->get_field_id( 'alfie_wp_weather_image' ); ?>"
                                                                                                    name="<?php echo $this->get_field_name( 'alfie_wp_weather_image' ); ?>"/> <?php _e( 'Show image?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_country' ); ?>"> <input class="checkbox"
                                                                                                      type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_country' ], true ); ?>
                                                                                                      id="<?php echo $this->get_field_id( 'alfie_wp_weather_country' ); ?>"
                                                                                                      name="<?php echo $this->get_field_name( 'alfie_wp_weather_country' ); ?>"/> <?php _e( 'Show country?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_condition' ); ?>"> <input class="checkbox"
                                                                                                        type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_condition' ], true ); ?>
                                                                                                        id="<?php echo $this->get_field_id( 'alfie_wp_weather_condition' ); ?>"
                                                                                                        name="<?php echo $this->get_field_name( 'alfie_wp_weather_condition' ); ?>"/> <?php _e( 'Show condition?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_highlow' ); ?>"> <input class="checkbox"
                                                                                                      type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_highlow' ], true ); ?>
                                                                                                      id="<?php echo $this->get_field_id( 'alfie_wp_weather_highlow' ); ?>"
                                                                                                      name="<?php echo $this->get_field_name( 'alfie_wp_weather_highlow' ); ?>"/> <?php _e( 'Show High/Low info?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_wind' ); ?>"> <input class="checkbox"
                                                                                                   type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_wind' ], true ); ?>
                                                                                                   id="<?php echo $this->get_field_id( 'alfie_wp_weather_wind' ); ?>"
                                                                                                   name="<?php echo $this->get_field_name( 'alfie_wp_weather_wind' ); ?>"/> <?php _e( 'Show wind info?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_humidity' ); ?>"> <input class="checkbox"
                                                                                                       type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_humidity' ], true ); ?>
                                                                                                       id="<?php echo $this->get_field_id( 'alfie_wp_weather_humidity' ); ?>"
                                                                                                       name="<?php echo $this->get_field_name( 'alfie_wp_weather_humidity' ); ?>"/> <?php _e( 'Show humidity info?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_visibility' ); ?>">
                    <input class="checkbox"
                           type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_visibility' ], true ); ?>
                           id="<?php echo $this->get_field_id( 'alfie_wp_weather_visibility' ); ?>"
                           name="<?php echo $this->get_field_name( 'alfie_wp_weather_visibility' ); ?>"/> <?php _e( 'Show visibility info?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_sunrise' ); ?>"> <input class="checkbox"
                                                                                                      type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_sunrise' ], true ); ?>
                                                                                                      id="<?php echo $this->get_field_id( 'alfie_wp_weather_sunrise' ); ?>"
                                                                                                      name="<?php echo $this->get_field_name( 'alfie_wp_weather_sunrise' ); ?>"/> <?php _e( 'Show sunrise info?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_sunset' ); ?>"> <input class="checkbox"
                                                                                                     type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_sunset' ], true ); ?>
                                                                                                     id="<?php echo $this->get_field_id( 'alfie_wp_weather_sunset' ); ?>"
                                                                                                     name="<?php echo $this->get_field_name( 'alfie_wp_weather_sunset' ); ?>"/> <?php _e( 'Show sunset info?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_forecast' ); ?>"> <input class="checkbox"
                                                                                                       type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_forecast' ], true ); ?>
                                                                                                       id="<?php echo $this->get_field_id( 'alfie_wp_weather_forecast' ); ?>"
                                                                                                       name="<?php echo $this->get_field_name( 'alfie_wp_weather_forecast' ); ?>"/> <?php _e( 'Show forecast?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_forecast_image' ); ?>">
                    <input class="checkbox"
                           type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_forecast_image' ], true ); ?>
                           id="<?php echo $this->get_field_id( 'alfie_wp_weather_forecast_image' ); ?>"
                           name="<?php echo $this->get_field_name( 'alfie_wp_weather_forecast_image' ); ?>"/> <?php _e( 'Show forecast images?', 'alfie_wp_weather' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'alfie_wp_weather_credits' ); ?>"> <input class="checkbox"
                                                                                                      type="checkbox" <?php checked( $instance[ 'alfie_wp_weather_credits' ], true ); ?>
                                                                                                      id="<?php echo $this->get_field_id( 'alfie_wp_weather_credits' ); ?>"
                                                                                                      name="<?php echo $this->get_field_name( 'alfie_wp_weather_credits' ); ?>"/> <?php _e( 'Show credits footer?', 'alfie_wp_weather' ); ?>
                </label>
            </p>
        </div>
        <div class="clear"></div>
    <?php
    }
}

?>
