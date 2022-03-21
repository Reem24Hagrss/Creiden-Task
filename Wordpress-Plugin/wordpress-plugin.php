<?php
/*
Plugin Name: Add Age Attribute to WordPress user
Description: Add Age Attribute to WordPress user
Version: 1.0
Author: Reem Hagrss
*/

add_action( 'show_user_profile', 'add_age_usermeta' );
add_action( 'edit_user_profile', 'add_age_usermeta' );

// add age input field to the user profile page
function add_age_usermeta( $user ) { ?>
    <h3><?php esc_html_e("Extra profile information", "crf"); ?></h3>
    <br>
    <table class="form-table">
    <tr>
        <th><label for="age"><?php esc_html_e("Age", 'crf'); ?></label></th>
        <td>
            <input type="number" min="1" name="age" id="age" value="<?php echo esc_html( get_usermeta(  $user->id , 'age') ); ?>" class="regular-text" /><br />
        </td>
    </tr>
    
    </table>
    <br>
<?php }

// add action to the age input field
add_action('personal_options_update', 'add_age_action');
add_action('edit_user_profile_update', 'add_age_action');
function add_age_action($user_id) {
    update_user_meta($user_id, 'age', $_POST['age']);
}

add_action( 'rest_api_init', 'add_user_age_api' );

function add_user_age_api() {
    register_rest_field('user',
        'age',
        array(
            'get_callback' => 'rest_get_user_age',
            'update_callback' => 'rest_update_user_age',
            'schema' => array(
                                'description' => 'The age of the user.',
                                'type' => 'number',
                                'context' => array('view', 'edit')
                            )
        )
    );
}

// Update Function
function rest_update_user_age( $user, $field_name, $value ) {
    // check value data type 
    if ( ! $value || ! is_numeric( $value ) ) {
        return;
    }
    // update value of user meta age
    return update_user_meta($user->id , $field_name , $value );
}

// Get Function
function rest_get_user_age( $user, $field_name, $request ) {
    // get value of user meta age
    return get_user_meta( $user->id , $field_name );
}