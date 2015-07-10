<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://wii.hatemzidi.com
 * @since      1.0.0
 *
 * @package    instg_imprtr
 * @subpackage instg_imprtr/admin/partials
 */


$params = get_option( $this->plugin_name . '-settings-params', array() );
print_r($params);
?>
<div class="wrap">
    <h2><?php _e( "WP Instagram Importer", "wpinstimp" ); ?></h2>

    <p><?php _e( 'Some blah blah', 'wp-inst-imp' ); ?></p>
</div>
<div class="wrap narrow">
    <!--        <h2>--><?php //_e('Add new cron schedule', 'wp-inst-imp'); ?><!--</h2>-->
    <!--        <p>-->
    <?php //// _e('Adding a new cron schedule will allow you to schedule events that re-occur at the given interval.', 'wp-inst-imp'); ?><!--</p>-->
    <form method="post" action="options-general.php?page=<?= $this->plugin_name ?>-manage_options">
        <table width="100%" cellspacing="2" cellpadding="5" class="editform form-table">
            <tbody>
            <tr>
                <th width="33%" valign="top" scope="row"><label
                        for="wpinstimp_userid"><?php _e( 'Instagram User ID', 'wp-inst-imp' ); ?></label></th>
                <td width="67%"><input type="text" size="40" value="<?= $params['userid'] ?>" id="wpinstimp_userid"
                                       name="wpinstimp_userid"/></td>
            </tr>
            <tr>
                <th width="33%" valign="top" scope="row"><label
                        for="wpinstimp_clientid"><?php _e( 'Instagram Client ID', 'wp-inst-imp' ); ?></label></th>
                <td width="67%"><input type="text" size="40" value="<?= $params['clientid'] ?>" id="wpinstimp_clientid"
                                       name="wpinstimp_clientid"/></td>
            </tr>
            <tr>
                <th width="33%" valign="top" scope="row"><label
                        for="wpinstimp_posts_count"><?php _e( 'Number of Instagrams to retrieve', 'wp-inst-imp' ); ?></label>
                </th>
                <td width="67%"><input type="text" size="40" value="<?= $params['count'] ?>" id="wpinstimp_posts_count"
                                       name="wpinstimp_posts_count"/></td>
            </tr>
            <tr>
                <th width="33%" valign="top" scope="row"><label
                        for="wpinstimp_categories"><?php _e( 'As category', 'wp-inst-imp' ); ?></label></th>
                <td width="67%">
                    <?php wp_dropdown_categories( array(
                        'hide_empty'   => 0,
                        'name'         => 'wpinstimp_category',
                        'hierarchical' => true,
                        'selected'     => $params['category']
                    ) ); ?></td>
            </tr>
            <tr>
                <th width="33%" valign="top" scope="row"><label
                        for="wpinstimp_user"><?php _e( 'As user', 'wp-inst-imp' ); ?></label></th>
                <td width="67%">
                    <?php wp_dropdown_users( array(
                        'name'     => 'wpinstimp_author',
                        'selected' => $params['author']
                    ) ); ?></td>
            </tr>
            <tr>
                <th width="33%" valign="top" scope="row"><label
                        for="wpinstimp_featured"><?php _e( 'Set as featured', 'wp-inst-imp' ); ?></label></th>
                <td width="67%"><input type="checkbox" size="40" value="featured" id="wpinstimp_featured"
                                       name="wpinstimp_featured" <?= ( ! empty( $params['isFeatured'] ) ? 'checked="checked"' : '' ) ?>/>
                </td>
            </tr>
            <tr>
                <th width="33%" valign="top" scope="row"><label
                        for="wpinstimp_content"><?php _e( 'Content for new post', 'wp-inst-imp' ); ?></label></th>
                <td width="67%"><textarea type="text" size="40" id="wpinstimp_content"
                                          name="wpinstimp_content"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit"><input id="wpinstimp_save" type="submit" class="button-primary"
                                 value="<?php _e( 'Save &raquo;', 'wp-inst-imp' ); ?>" name="wpinstimp_save"/></p>
        <?php wp_nonce_field( 'wpinst_saved' ) ?>
    </form>
</div>