<?php if ( is_user_logged_in() ) : ?>

<ul class="nd_tabs">

<li class="active">
	<a href="#nd_user"><?php _e( 'You', 'gameleon' ); ?></a>
</li>


<li>
<a href="#nd_recently_viewed">
<?php _e('My Activity', 'gameleon'); ?>
</a>
</li>


<?php if ( class_exists( 'UserOnline_Core') ) : ?>
<li>
<a href="#nd_online_users">
<?php _e('Who\'s Online', 'gameleon'); ?>
</a>
</li>
<?php endif; ?>
</ul>

<?php else : ?>

<ul class="nd_tabs">

<li class="active">
<a href="#nd_login_form">
<?php _e( 'Log in', 'gameleon' ); ?>
</a>
</li>

<?php if ( get_option( 'users_can_register' ) ) : ?>

<li>
<a href="#nd_register_form">
<?php _e( 'Register', 'gameleon' ); ?>
</a>
</li>
<?php endif; ?>

<?php if ( class_exists( 'UserOnline_Core') ) : ?>
<li>
<a href="#nd_online_users_off">
<?php _e( 'Who\'s Online', 'gameleon' ); ?>
</a>
</li>
<?php endif; ?>
</ul>

<?php endif; ?>