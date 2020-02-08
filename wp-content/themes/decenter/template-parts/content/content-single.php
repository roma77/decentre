<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Decenter
 * @since 1.0.0
 */

?>
<?php 


$categories = get_the_category();
$category_name = '';
if($categories){
	foreach($categories as $category) {
		$category_name .= '<a href="'.get_category_link($category->term_id ).'">' . $category->name . '</a>&nbsp;';
	}
	trim($category_name, '&nbsp;');
}

?>


<div itemscope="itemscope" itemtype="http://schema.org/Article" class="post-padding">
    <div class="post-header u-container">
		<?php if ($category_name) { ?>
			<div class="category-name">
				<?php echo $category_name;?>
			</div>
		<?php } ?>
        <div itemprop="name" class="title">
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="share-box">
            <div class="author">
			<?php 
			$author_img = get_avatar( get_the_author_meta( 'email' ), 50 );
			$author_link  = get_author_posts_url( get_the_author_meta( 'ID' ) );
			?>
			
			
			<?php printf( '<a href="%s" alt="author_foto">%s</a>', $author_link, $author_img ); ?>
                <div class="info">
                    <div class="name">
						<?php printf( '<a href="%s">%s</a>', $author_link, get_the_author() ); ?>
					</div>
                    <div itemprop="dateCreated" class="date"><?php echo date_i18n ( 'j F Y - H:i', strtotime( get_the_date('j F Y - H:i') )); ?> (UTC)</div>
                </div>
            </div>
			<?php 
			$url = get_the_title().' '. get_permalink();
			$link = get_permalink();
			?>
            <div class="share-buttons-mobile">
				<a target="_blank" href="tg://msg?text=<?php echo urlencode($url); ?>>">
                    <div class="social tg"></div>
                </a> 
				<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($link); ?>">
                    <div class="social fb"></div>
                </a> 
				
				<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($url); ?>">
			
                    <div class="social tw"></div>
                </a> <a target="_blank" href="https://vk.com/share.php?url=<?php echo urlencode($link); ?>">
			
                    <div class="social vk"></div>
                </a> 
				<a target="_blank" href="whatsapp://send?text=<?php echo urlencode($url); ?>">
                    <div class="social wa"></div>
                </a>
			</div>
            <div class="voting-stats">
                <div class="read-time">
                    <div class="read-time-icon"><img src="<?php echo get_template_directory_uri(); ?>/img/time.svg"></div>
                    <div class="read-time-text">
                        6 min
                    </div>
                </div>
            </div>
        </div>
        <div id="share" class="share-buttons" style="position: absolute;"><a target="_blank" href="tg://msg?text=<?php echo urlencode($url); ?>">
                <div class="social tg"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3799 22.3877L18.3797 22.3876L18.38 22.3874L18.38 22.3872L18.3801 22.3873L25.596 16.035C25.9127 15.7608 25.5269 15.6271 25.1064 15.8758L16.2005 21.3567L12.3536 20.1855C11.5229 19.9374 11.5169 19.3805 12.5402 18.9801L27.5306 13.3416C28.2152 13.0384 28.876 13.502 28.6147 14.5242L26.0618 26.2594C25.8835 27.0933 25.367 27.2928 24.6513 26.9076L20.7625 24.1049L18.8933 25.8779C18.8874 25.8835 18.8815 25.8891 18.8757 25.8946C18.6666 26.0932 18.4936 26.2574 18.1151 26.2574L18.3799 22.3877Z" fill="black"></path>
                    </svg></div>
            </a> <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($link); ?>">
                <div class="social fb"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M30 28.8961C30 29.5057 29.5057 30 28.8962 30H23.7997V22.2549H26.3994L26.7886 19.2365H23.7997V17.3094C23.7997 16.4355 24.0424 15.84 25.2955 15.84L26.8939 15.8393V13.1396C26.6175 13.1028 25.6687 13.0207 24.5648 13.0207C22.2603 13.0207 20.6826 14.4273 20.6826 17.0105V19.2365H18.0763V22.2549H20.6826V30H11.1038C10.494 30 10 29.5057 10 28.8961V11.1038C10 10.4941 10.4941 10 11.1038 10H28.8962C29.5058 10 30 10.4941 30 11.1038V28.8961Z" fill="black"></path>
                    </svg></div>
            </a> <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($url); ?>">
                <div class="social tw"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M31 13.8937C30.2642 14.2153 29.4735 14.4317 28.6431 14.5309C29.4888 14.0289 30.1421 13.2384 30.4474 12.2946C29.6536 12.7575 28.7744 13.0941 27.8402 13.2745C27.0922 12.4899 26.0267 12 24.8452 12C22.5799 12 20.742 13.8095 20.742 16.0398C20.742 16.3554 20.7787 16.665 20.8489 16.9596C17.4387 16.7913 14.4163 15.1802 12.3922 12.7364C12.038 13.3346 11.8365 14.0289 11.8365 14.7714C11.8365 16.1721 12.5601 17.4075 13.6622 18.1319C12.9875 18.1108 12.3555 17.9305 11.8029 17.6269C11.8029 17.6449 11.8029 17.66 11.8029 17.678C11.8029 19.6348 13.2165 21.267 15.094 21.6397C14.749 21.7329 14.3888 21.781 14.0133 21.781C13.7477 21.781 13.4912 21.7569 13.2409 21.7088C13.7629 23.3109 15.2772 24.4832 17.0724 24.5132C15.671 25.5983 13.9003 26.2416 11.977 26.2416C11.6442 26.2416 11.3206 26.2236 11 26.1875C12.8135 27.3327 14.9719 28 17.2891 28C24.8361 28 28.9637 21.8441 28.9637 16.5087C28.9637 16.3314 28.9606 16.1571 28.9515 15.9827C29.7544 15.4176 30.4505 14.7052 31 13.8937Z" fill="black"></path>
                    </svg></div>
            </a> <a target="_blank" href="https://vk.com/share.php?url=<?php echo urlencode($link); ?>">
                <div class="social vk"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.7586 26.6965H21.1035C21.1035 26.6965 21.5096 26.6521 21.7172 26.4301C21.9081 26.2262 21.902 25.8434 21.902 25.8434C21.902 25.8434 21.8757 24.0509 22.7131 23.787C23.5389 23.5268 24.5991 25.5193 25.7227 26.2855C26.5725 26.8651 27.2182 26.7382 27.2182 26.7382L30.223 26.6965C30.223 26.6965 31.7947 26.6002 31.0494 25.3727C30.9884 25.2724 30.6152 24.4646 28.8152 22.8051C26.931 21.068 27.1836 21.3491 29.4531 18.3444C30.8353 16.5146 31.3877 15.3976 31.2151 14.9192C31.0506 14.4634 30.0339 14.5838 30.0339 14.5838L26.6508 14.6045C26.6508 14.6045 26.3998 14.5706 26.2139 14.6811C26.0321 14.7892 25.9154 15.0416 25.9154 15.0416C25.9154 15.0416 25.3797 16.4575 24.6659 17.6618C23.1594 20.2027 22.5569 20.3372 22.3107 20.1791C21.7378 19.8114 21.8809 18.702 21.8809 17.9137C21.8809 15.4513 22.257 14.4246 21.1487 14.1588C20.781 14.0707 20.5101 14.0123 19.5696 14.0028C18.3623 13.9906 17.3408 14.0065 16.7623 14.288C16.3774 14.4752 16.0804 14.8923 16.2614 14.9163C16.4851 14.9459 16.9913 15.0521 17.2598 15.4149C17.6066 15.8836 17.5944 16.9356 17.5944 16.9356C17.5944 16.9356 17.7937 19.8343 17.1292 20.1942C16.6732 20.4412 16.0476 19.9371 14.7045 17.6318C14.0165 16.451 13.4968 15.1457 13.4968 15.1457C13.4968 15.1457 13.3968 14.9018 13.218 14.7712C13.0012 14.613 12.6983 14.5629 12.6983 14.5629L9.48336 14.5838C9.48336 14.5838 9.00085 14.5971 8.82353 14.8056C8.66578 14.9912 8.81093 15.3745 8.81093 15.3745C8.81093 15.3745 11.3278 21.2235 14.1778 24.1711C16.7914 26.8739 19.7586 26.6965 19.7586 26.6965Z" fill="black"></path>
                    </svg></div>
            </a> <a target="_blank" href="whatsapp://send?text=<?php echo urlencode($url); ?>">
                <div class="social wa"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.0428 10C22.7064 10 25.2064 11.0312 27.0872 12.9075C28.9681 14.78 30 17.2689 30 19.9167C29.9961 25.3828 25.5296 29.8294 20.0428 29.8294H20.0389C18.3723 29.8255 16.7329 29.4107 15.2804 28.6199L10 30L11.4136 24.8633C10.5413 23.3631 10.0818 21.6573 10.0857 19.9089C10.0857 14.4466 14.5522 10 20.0428 10ZM23.236 24.6269C23.6916 24.5881 24.7079 24.0299 24.9143 23.4522C25.1207 22.8746 25.1207 22.3784 25.0584 22.2737C25.008 22.1922 24.8915 22.1361 24.717 22.052C24.6757 22.0321 24.6311 22.0106 24.5833 21.9868C24.3341 21.8628 23.1114 21.2619 22.8816 21.1805C22.6558 21.0991 22.4883 21.0564 22.3248 21.3045C22.1573 21.5526 21.6822 22.1109 21.5343 22.2737C21.3902 22.4404 21.2461 22.4598 20.9969 22.3357C20.956 22.3154 20.9003 22.2914 20.8315 22.2618C20.4806 22.1107 19.7897 21.8133 18.9953 21.1068C18.2555 20.4516 17.757 19.6414 17.6129 19.3933C17.4688 19.1452 17.5974 19.0095 17.722 18.8854C17.7972 18.8131 17.8829 18.7097 17.9686 18.6063C18.0114 18.5546 18.0543 18.5029 18.0958 18.4551C18.2031 18.3242 18.2489 18.23 18.3151 18.0936C18.3234 18.0766 18.332 18.0589 18.3411 18.0403C18.4268 17.8775 18.384 17.7302 18.3217 17.6061C18.2956 17.5543 18.1964 17.3108 18.0734 17.009C17.9017 16.5878 17.6838 16.0531 17.5545 15.7686C17.3676 15.3576 17.1729 15.346 16.9938 15.3421C16.8497 15.3344 16.6822 15.3344 16.5187 15.3344C16.3512 15.3344 16.0826 15.3964 15.8528 15.6445C15.8373 15.6615 15.8198 15.6802 15.8008 15.7006C15.5418 15.9775 14.9844 16.5734 14.9844 17.7108C14.9844 18.9281 15.8723 20.1066 15.9969 20.2694C16.0061 20.2818 16.0234 20.3074 16.0486 20.3446C16.3632 20.8101 17.9056 23.0916 20.2492 24.0105C22.1491 24.7544 22.6802 24.6915 23.1047 24.6413C23.1491 24.636 23.1924 24.6309 23.236 24.6269Z" fill="black"></path>
                    </svg></div>
            </a></div>
        <div class="arrow-top"></div>
    </div>
    <div class="post-body u-container">
        <div itemprop="articleBody">
            <div class="stk-post stk-layout_4col_12080 stk-theme_14405" data-editor-version="1.18.3" data-layout-type="auto" data-reset-type="class" data-ui-id="post">
                <?php if (has_excerpt()) { ?>
					<h2 class="stk-reset stk-theme_14405__style_large_header">
						<?php the_excerpt(); ?>
					</h2>
				<?php } ?>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <div class="u-container">
        <?php get_template_part( 'template-parts/content/subscribe' ); ?>
    </div>
</div>


