<?php
/**
 * Theme Customizer Option
 */
function pp_pyapal_url_and_name( $wp_customize ) {
    $wp_customize->add_setting( 'pp_paypal_name',[
        'default'       =>  ''
    ]);

    $wp_customize->add_setting( 'pp_hero_img',[
        'default'       =>  ''
    ]);


    $wp_customize->add_section( 'pp_paypal_settings',[
        'title'         =>  __( 'Paypal Settings' ,'kadence-child' ),
        'priority'      =>  40
    ]);


    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'pp_paypal_name_input',
        array(
            'label'          => __( 'Paypal Name', 'kadence-child' ),
            'section'        => 'pp_paypal_settings',
            'settings'       => 'pp_paypal_name',
            'type'           =>'text'
        )
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'pp_hero_img_input',
            array(
                'label'      => __( 'Home Section middle Image', 'twentyseventeen' ),
                'section'    => 'pp_paypal_settings',
                'settings'   => 'pp_hero_img'
            )
        )
    );
}
?>