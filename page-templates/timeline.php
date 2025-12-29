<?php
/**
 * Template Name: Timeline
 *
 * @package      GoodShepherd
 */

get_header();

$page_banner = get_field('page_banner', get_the_ID());
$banner_image = $page_banner['image'] ?? null;
$headline = $page_banner['headline'] ?? '';
$call_to_action = $page_banner['call_to_action'] ?? '';
$banner_bg_color = $page_banner['background_color'] ?? '';
$banner_bg_style = '';
if ($banner_bg_color) {
    $banner_bg_style = 'background-color: ' . $banner_bg_color . ';';
}
?>

<main id="primary" class="site-main timeline-page">

    <!-- Banner -->
    <div class="bg-white text-[#3E3E3E] border-b border-[#C4C4C4]">
        <div class="bg-[#EBDCEC] pt-12 pb-20 md:pt-16 md:pb-24 xl:pt-12 xl:pb-12 relative z-20" style="<?php echo esc_attr($banner_bg_style); ?>">
            <div class="container mx-auto xl:min-h-[420px] flex flex-wrap gap-6 md:flex-nowrap md:items-center md:gap-x-10 xl:gap-x-16 px-4">
                <div class="w-full max-w-[180px] md:max-w-none md:w-1/4 lg:md-1/4">
                    <?php if ($banner_image) : ?>
                        <img class="block" src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr($banner_image['alt']); ?>">
                    <?php else : ?>
                        <img class="block" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/160-years-young.png'; ?>" alt="160 years young">
                    <?php endif; ?>
                </div>
                <div class="w-full md:w-3/4 lg:w-3/4">
                    <?php if ($headline) : ?>
                        <h2 class="text-xl leading-tight lg:text-3xl lg:leading-tight xl:text-[40px] xl:leading-tight text-black font-bold mb-8 xl:mb-10"><?php echo wp_kses_post($headline); ?></h2>
                    <?php else : ?>
                        <h2 class="text-xl leading-tight lg:text-3xl lg:leading-tight xl:text-[40px] xl:leading-tight text-black font-bold mb-8 xl:mb-10">We invite you to explore the timeline of our rich history and audacious future, striving to ensure women, girls and families are safe, well, strong and connected.</h2>
                    <?php endif; ?>
                    <?php if ($call_to_action) : ?>
                        <div class="text-[#B86AAA] text-lg leading-tight lg:text-[26px] lg:leading-tight xl:text-[30px] xl:leading-tight font-bold"><?php echo wp_kses_post($call_to_action); ?></div>
                    <?php else : ?>
                        <div class="text-[#B86AAA] text-lg leading-tight lg:text-[26px] lg:leading-tight xl:text-[30px] xl:leading-tight font-bold">If you’d like to donate to support our work, please <a href="#" class="text-black underline hover:no-underline">click here.</a></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="absolute left-4 bottom-4 md:bottom-8 md:left-1/2 md:-translate-x-1/2">
                <div class="flex flex-col md:items-center">
                    <div class="text-red text-xl font-medium mb-4 md:mb-2">Explore 160 Years</div>
                    <div>
                        <svg class="h-3 w-auto" xmlns="http://www.w3.org/2000/svg" width="26.5" height="15.148" viewBox="0 0 26.5 15.148">
                            <path id="Shape" d="M14.6,14.562,3.177,25.956A1.858,1.858,0,1,1,.545,23.332L10.655,13.25.545,3.168A1.858,1.858,0,0,1,3.177.544L14.6,11.938a1.852,1.852,0,0,1,0,2.624Z" transform="translate(26.5) rotate(90)" fill="#d72b32" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Nav & Content -->
    <div class="bg-white relative">
        <div class="sticky top-0 z-30 bg-white">
            <div class="bg-purple text-white">
                <div class="container mx-auto px-9 xl:px-16 2xl:px-4">
                    <div class="timeline-nav-container relative">
                        <?php
                        $args = array(
                            'post_type' => 'timeline',
                            'post_status' => 'publish',
                            'orderby' => 'menu_order'
                        );
                        $the_query = new WP_Query($args);
                        ?>
                        <?php if ($the_query->have_posts()) { ?>
                            <div id="timeline-nav" class="swiper">
                                <div class="swiper-wrapper">
                                    <?php while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                        $id = get_the_ID();
                                        $post = get_post($id);
                                        $slug = $post->post_name;
                                        $period = get_field('period', $id);
                                        $title = $period['title'] ?? get_the_title();
                                    ?>
                                        <div class="swiper-slide">
                                            <a href="#<?php echo esc_attr($slug); ?>" class="nav-link inline-flex h-16 xl:h-24 items-center text-sm xl:text-base text-white no-underline border-t-4 border-transparent hover:border-white transition-all duration-300"><span class="px-4 py-2 xl:py-4 xl:px-10 border-r border-solid border-[#8D397E]"><?php echo esc_html($title); ?></span></a>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php } wp_reset_postdata(); ?>
                        
                        <button type="button" class="timeline-nav--button-prev">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.49994 1.00001C7.63154 0.999249 7.76201 1.02447 7.88384 1.07424C8.00568 1.124 8.1165 1.19733 8.20994 1.29001C8.30367 1.38297 8.37806 1.49357 8.42883 1.61543C8.4796 1.73729 8.50574 1.868 8.50574 2.00001C8.50574 2.13202 8.4796 2.26273 8.42883 2.38459C8.37806 2.50645 8.30367 2.61705 8.20994 2.71001L4.89994 6.00001L8.07994 9.31001C8.26619 9.49737 8.37073 9.75082 8.37073 10.015C8.37073 10.2792 8.26619 10.5326 8.07994 10.72C7.98698 10.8137 7.87637 10.8881 7.75452 10.9389C7.63266 10.9897 7.50195 11.0158 7.36994 11.0158C7.23793 11.0158 7.10722 10.9897 6.98536 10.9389C6.8635 10.8881 6.7529 10.8137 6.65994 10.72L2.79994 6.72001C2.61671 6.53308 2.51408 6.28176 2.51408 6.02001C2.51408 5.75826 2.61671 5.50694 2.79994 5.32001L6.79994 1.32001C6.8897 1.22308 6.99777 1.14489 7.11792 1.08997C7.23807 1.03504 7.36791 1.00447 7.49994 1.00001V1.00001Z" fill="currentColor"></path>
                            </svg>
                        </button>
                        <button type="button" class="timeline-nav--button-next">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.49994 11C4.36833 11.0008 4.23787 10.9755 4.11603 10.9258C3.9942 10.876 3.88338 10.8027 3.78994 10.71C3.69621 10.617 3.62182 10.5064 3.57105 10.3846C3.52028 10.2627 3.49414 10.132 3.49414 9.99999C3.49414 9.86798 3.52028 9.73727 3.57105 9.61541C3.62182 9.49355 3.69621 9.38295 3.78994 9.28999L7.09994 5.99999L3.91994 2.68999C3.73369 2.50263 3.62915 2.24918 3.62915 1.98499C3.62915 1.7208 3.73369 1.46735 3.91994 1.27999C4.0129 1.18626 4.1235 1.11187 4.24536 1.0611C4.36722 1.01033 4.49793 0.984192 4.62994 0.984192C4.76195 0.984192 4.89266 1.01033 5.01452 1.0611C5.13638 1.11187 5.24698 1.18626 5.33994 1.27999L9.19994 5.27999C9.38317 5.46692 9.4858 5.71824 9.4858 5.97999C9.4858 6.24174 9.38317 6.49306 9.19994 6.67999L5.19994 10.68C5.11018 10.7769 5.00211 10.8551 4.88196 10.91C4.76181 10.965 4.63197 10.9955 4.49994 11V11Z" fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white relative z-20">
            <div class="relative container mx-auto pr-2 pl-[64px] pt-6 pb-10 md:px-4 md:py-10 overflow-hidden">
                <!-- Legend -->
                <div class="flex gap-x-3 md:gap-x-32 xl:gap-x-72">
                    <div class="flex gap-x-2 md:w-1/2">
                        <div class="flex-none w-4 h-4 bg-black rounded-full md:hidden"></div>
                        <h3 class="text-[15px] leading-tight md:text-xl xl:text-3xl text-black font-bold m-0">Historical context</h3>
                    </div>
                    <div class="flex gap-x-2 md:w-1/2">
                        <div class="flex-none w-4 h-4 bg-red rounded-full md:hidden"></div>
                        <h3 class="text-[15px] leading-tight md:text-xl xl:text-3xl text-red font-bold m-0">Good Shepherd’s response</h3>
                    </div>
                </div>
                <!-- SVG Illustration -->
                <div class="absolute -bottom-4 left-6 md:bottom-0 md:left-1/2 md:-translate-x-[6px] h-full flex items-end">
                    <svg width="54" height="149" viewBox="0 0 54 149" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.00582 149H7.00583L7.00582 148.997C7.0045 148.474 7.00261 147.974 7.00012 147.497C7.00034 133.055 8.80578 117.328 14.5478 104.867C17.1756 99.1646 20.6203 94.156 25.0958 90.2632C27.8042 93.1145 30.4704 95.0861 33.0367 96.3444C38.9192 99.2286 44.1898 98.3176 47.9614 95.7986C51.663 93.3263 53.972 89.2562 53.878 85.7692C53.8299 83.9893 53.1456 82.3196 51.646 81.1888C50.1673 80.074 48.0426 79.594 45.3216 79.8533C37.1816 80.6285 30.5952 83.3766 25.2965 87.5077C22.4137 84.1819 19.4365 79.7267 16.46 73.8668C4.26093 49.851 1.91493 31.6951 2.57987 19.5973C2.91255 13.5447 3.99951 8.99561 4.99394 5.97473C5.49127 4.46399 5.96571 3.33472 6.31161 2.59009C6.48457 2.21777 6.6254 1.94165 6.72088 1.76209C6.76863 1.67224 6.80503 1.60669 6.82845 1.56519C6.84016 1.54443 6.84862 1.52979 6.85363 1.52124L6.85852 1.51282C6.85852 1.51282 6.84936 1.50832 6.00012 0.999878C5.14215 0.486206 5.14119 0.487793 5.14119 0.487793L5.13628 0.496094L5.1251 0.515137C5.1159 0.531006 5.10326 0.552857 5.08739 0.580933C5.05565 0.637085 5.01097 0.717773 4.95504 0.822998C4.84319 1.03333 4.6863 1.34167 4.49777 1.74744C4.12072 2.55908 3.61714 3.76086 3.09423 5.34937C2.04818 8.5271 0.925769 13.2493 0.582889 19.4875C-0.103278 31.9714 2.33486 50.4753 14.6768 74.7726C17.6898 80.7041 20.7415 85.2982 23.7534 88.7808C19.0588 92.8755 15.4562 98.1169 12.7314 104.03C6.81145 116.877 5.00012 132.943 5.00011 147.5L5.00014 147.505C5.00261 147.98 5.0045 148.478 5.00582 149ZM33.9172 94.5486C31.6243 93.4243 29.1787 91.6362 26.6469 88.9915C31.6561 85.1245 37.8585 82.5731 45.5112 81.8442C47.9306 81.6138 49.4955 82.0723 50.4419 82.7858C51.3675 83.4836 51.8438 84.5325 51.8787 85.8231C51.9503 88.4772 50.1137 91.9559 46.8506 94.1354C43.6576 96.2681 39.1447 97.1117 33.9172 94.5486Z" fill="#86774F" />
                    </svg>
                </div>
            </div>

            <!-- Entries Loop -->
            <div class="relative">
                <?php
                if ($the_query->have_posts()) { ?>
                    <div class="timeline-entries">
                        <?php while ($the_query->have_posts()) :
                            $the_query->the_post();
                            $id = get_the_ID();
                            $post = get_post($id);
                            $slug = $post->post_name;
                            $period = get_field('period', $id);
                            $title = $period['title'] ?? get_the_title();
                            $sub_title = $period['sub_title'];
                            $description = $period['description'];
                            $background = $period['background'];
                            $background_color = $background['background_color'] ?? '';
                            $timeline = get_field('timeline', $id);
                            
                            $period_style = '';
                            if ($background_color) {
                                // $period_style = 'background-color: ' . $background_color . ';';
                            }
                        ?>
                            <div id="<?php echo esc_attr($slug); ?>" data-postid="<?php echo esc_attr($id); ?>" class="timeline-section relative bg-cover bg-no-repeat scroll-mt-32" style="<?php echo esc_attr($period_style); ?>">

                                <div class="timeline-container relative container mx-auto px-4 z-10">
                                    <div class="timeline-border-center absolute top-[65px] bottom-[65px] left-[30px] md:left-1/2 -translate-x-1/2 w-[2px] bg-[#86774F]"></div>
                                    
                                    <div class="timeline-content relative pl-16 md:pl-0">
                                        <div class="flex flex-wrap md:flex-nowrap md:gap-x-32 xl:gap-x-72 py-20 md:py-10 xl:py-20">
                                            
                                            <!-- Period Info -->
                                            <div class="w-full md:w-1/2">
                                                <div class="period-entry">
                                                    <?php if ($title) : ?>
                                                        <h3 class="font-bold text-[40px] leading-tight md:text-4xl xl:text-[48px] mb-6 lg:mb-8 xl:mb-12 text-[#85774F]"><?php echo esc_html($title); ?></h3>
                                                    <?php endif; ?>
                                                    <?php if ($sub_title) : ?>
                                                        <h4 class="text-[#707070] font-bold text-lg leading-tight xl:text-xl"><?php echo esc_html($sub_title); ?></h4>
                                                    <?php endif; ?>
                                                    <?php if ($description) : ?>
                                                        <div class="text-base xl:text-xl">
                                                            <?php echo wp_kses_post($description); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- Timeline Dots -->
                                            <div class="w-full md:w-1/2">
                                                <?php if ($timeline) : ?>
                                                    <div class="pt-8 md:pt-16">
                                                        <?php
                                                        foreach ($timeline as $key => $dot) :
                                                            $year = $dot['year'];
                                                            $unique_id = $dot['unique_id'];
                                                            $type = $dot['type'];
                                                            $excerpt = $dot['excerpt'];
                                                            $disable_link = $dot['disable_link'];
                                                            $image_main = $dot['image'];
                                                            $pop_up_content = $dot['pop_up_content'];
                                                            $image_video = $pop_up_content['image_video'];
                                                            $use_image_or_video = $image_video['use_image_or_video'];
                                                            $image = $image_video['image'];
                                                            $video = $image_video['video'];
                                                            $gallery = $image_video['gallery'];
                                                            $content = $pop_up_content['content'];
                                                            $use_external_link = $pop_up_content['use_external_link'];
                                                            $external_link = $pop_up_content['external_link'];

                                                            $modal_key = $unique_id ?: $year;
                                                            $timeline_key = $unique_id ?: $year;
                                                            
                                                            if ($type == 'historical') {
                                                                $modal_id = 'h-' . $modal_key;
                                                                $timeline_id = 'tlh-' . $timeline_key;
                                                            } else {
                                                                $modal_id = 'gs-' . $modal_key;
                                                                $timeline_id = 'tl-gs-' . $timeline_key;
                                                            }

                                                            if ($key == '0' && $type == 'historical') {
                                                                echo '<div class="period-spacer hidden md:block"></div>';
                                                            }
                                                        ?>

                                                            <!-- Timeline Entry -->
                                                            <?php if ($type == 'historical') { ?>
                                                                <div id="<?php echo esc_attr($timeline_id); ?>" class="timeline-entry relative text-base xl:text-xl pb-16 md:pb-20 xl:pb-24 md:-translate-x-full md:pr-16 md:-ml-16 xl:-ml-36 xl:pr-36">
                                                                    <!-- Historical Dot -->
                                                                    <div class="absolute -left-[60px] md:left-auto md:right-0">
                                                                        <div class="flex items-center gap-x-2 md:gap-x-0 xl:gap-x-2">
                                                                            <div class="w-5 xl:w-16 h-0.5 bg-[#3E3E3E] order-2 md:order-1"></div>
                                                                            <div class="w-5 h-5 xl:w-6 xl:h-6 bg-[#3E3E3E] rounded-full md:translate-x-1/2 pulse-black order-1 md:order-2"></div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <!-- Content -->
                                                                    <div>
                                                                        <?php if ($image_main) : ?>
                                                                            <div class="mb-6 max-w-[280px]">
                                                                                <div class="aspect-w-1 aspect-h-1">
                                                                                    <img class="object-cover h-full w-full rounded-full" src="<?php echo esc_url($image_main['url']); ?>" alt="">
                                                                                </div>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        
                                                                        <?php if ($excerpt) : 
                                                                            $excerpt_html = '<span class="font-bold text-[#3E3E3E]">' . $year . ' -</span> <span class="text-[#3E3E3E]">' . $excerpt . '</span>';
                                                                            if (!$disable_link && $use_external_link) {
                                                                                echo '<a href="' . esc_url($external_link['url']) . '" target="_blank" class="text-[#3E3E3E] underline hover:no-underline">' . $excerpt_html . '</a>';
                                                                            } elseif (!$disable_link) {
                                                                                echo '<a href="#' . esc_attr($modal_id) . '" data-fancybox="timeline-b" data-src="#' . esc_attr($modal_id) . '" class="text-[#3E3E3E] underline hover:no-underline">' . $excerpt_html . '</a>';
                                                                            } else {
                                                                                echo $excerpt_html;
                                                                            }
                                                                        endif; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { 
                                                                // Good Shepherd Entry
                                                                ?>
                                                                <div class="mb-8">
                                                                    <!-- Heart SVG -->
                                                                    <svg class="gs-heart w-auto h-[48px] xl:h-[55px]" width="88" height="55" viewBox="0 0 88 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M2.34018 10.2569C2.56984 9.19072 2.95888 8.16521 3.49418 7.21494C3.89133 6.56513 4.43219 6.01503 5.07518 5.60694C5.27518 5.48594 5.48218 5.34794 5.68918 5.24494L5.73118 5.22294C11.2232 2.52294 17.4182 6.04094 20.0222 11.8229L20.1992 12.2089L21.4302 9.60894C21.4302 9.60894 22.0092 8.53394 22.2832 8.06894C22.9565 6.82078 23.8993 5.73824 25.0432 4.89994C26.4838 4.08213 28.1142 3.65779 29.7707 3.66955C31.4271 3.68131 33.0514 4.12875 34.4802 4.96694C40.1562 8.38894 40.0242 15.8049 38.5662 21.6589C36.6912 29.1859 31.8072 36.6279 25.4662 42.2289C14.1512 36.4149 -0.390816 24.6909 2.34018 10.2569ZM28.9292 43.8729C28.1712 43.5429 27.3832 43.1779 26.5752 42.7829C33.0865 36.2948 37.8906 28.296 40.5592 19.4999C42.8642 11.4609 38.9172 -4.60006 27.3302 1.56694C24.8532 2.88494 22.9302 5.59394 21.5612 8.30494C17.9722 1.06394 9.22318 -1.18006 4.04218 5.07594C4.04918 5.05994 4.05418 5.04394 4.06218 5.02794C4.04118 5.06494 4.01218 5.10794 3.99018 5.14494C3.70171 5.48788 3.4323 5.84642 3.18318 6.21894C-3.29182 16.0999 1.60618 27.5639 9.53818 34.8809C13.5744 38.5921 18.0734 41.766 22.9232 44.3239C18.3909 47.8967 13.0552 50.3095 7.37918 51.3529C6.62818 51.4729 6.31018 54.2899 5.60018 54.3999C12.3342 53.3189 18.7192 49.8279 24.2112 44.9999C42.9632 54.4209 65.7832 54.8219 86.0442 49.1189C86.8672 48.8879 87.0362 46.2899 87.8252 46.0679C69.5002 51.2249 46.6092 51.5609 28.9292 43.8729Z" fill="#D72B32" />
                                                                    </svg>
                                                                </div>

                                                                <div id="<?php echo esc_attr($timeline_id); ?>" class="timeline-entry relative text-base xl:text-xl pb-16 md:pb-20 xl:pb-24">
                                                                    <div class="absolute -left-[60px] md:-left-16 xl:-left-36">
                                                                        <div class="flex items-center gap-x-2 md:gap-x-0 xl:gap-x-2">
                                                                            <div class="w-5 h-5 xl:w-6 xl:h-6 bg-red rounded-full md:-translate-x-1/2 pulse-red"></div>
                                                                            <div class="w-5 xl:w-16 h-0.5 bg-red"></div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div>
                                                                        <?php if ($image_main) : ?>
                                                                            <div class="mb-6 max-w-[280px]">
                                                                                <a href="#<?php echo esc_attr($modal_id); ?>" data-fancybox="timeline-b" data-src="#<?php echo esc_attr($modal_id); ?>">
                                                                                    <div class="aspect-w-1 aspect-h-1">
                                                                                        <img class="object-cover h-full w-full rounded-full" src="<?php echo esc_url($image_main['url']); ?>" alt="">
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        
                                                                        <?php if ($excerpt) : 
                                                                            $excerpt_html = '<span class="font-bold text-red">' . $year . ' -</span> <span class="text-[#3E3E3E]">' . $excerpt . '</span>';
                                                                            if (!$disable_link && $use_external_link) {
                                                                                echo '<a href="' . esc_url($external_link['url']) . '" target="_blank" class="text-[#3E3E3E] underline hover:no-underline">' . $excerpt_html . '</a>';
                                                                            } elseif (!$disable_link) {
                                                                                echo '<a href="#' . esc_attr($modal_id) . '" data-fancybox="timeline-b" data-src="#' . esc_attr($modal_id) . '" class="text-[#3E3E3E] underline hover:no-underline">' . $excerpt_html . '</a>';
                                                                            } else {
                                                                                echo $excerpt_html;
                                                                            }
                                                                        endif; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>

                                                            <!-- Modal Content -->
                                                            <div id="<?php echo esc_attr($modal_id); ?>" class="w-full !max-w-3xl !p-0 !rounded-xl min-w-[280px] md:min-w-[640px] lg:min-w-[768px]" style="display:none;">
                                                                <?php if ($use_image_or_video == 'image' && $image) : ?>
                                                                    <div class="aspect-w-16 aspect-h-9 rounded-t-xl overflow-hidden">
                                                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full h-full object-center object-cover">
                                                                    </div>
                                                                <?php elseif ($use_image_or_video == 'video' && $video['video_link']) : ?>
                                                                    <div class="aspect-w-16 aspect-h-9 rounded-t-xl overflow-hidden">
                                                                        <?php echo $video['video_link']; ?>
                                                                    </div>
                                                                <?php elseif ($use_image_or_video == 'gallery' && $gallery) : ?>
                                                                    <div id="swiper-<?php echo esc_attr($modal_id); ?>" class="swiper rounded-t-xl overflow-hidden">
                                                                        <div class="swiper-wrapper">
                                                                            <?php foreach ($gallery as $gal_img) : ?>
                                                                                <div class="swiper-slide">
                                                                                    <div class="aspect-w-16 aspect-h-9">
                                                                                        <img src="<?php echo esc_url($gal_img['url']); ?>" alt="<?php echo esc_attr($gal_img['alt']); ?>" class="h-full w-full object-cover" />
                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                        <div class="swiper-pagination"></div>
                                                                        <div class="swiper-button-prev"></div>
                                                                        <div class="swiper-button-next"></div>
                                                                    </div>
                                                                <?php endif; ?>
                                                                
                                                                <?php if ($year || $excerpt || $content) : ?>
                                                                    <div class="p-8">
                                                                        <?php if ($year) echo '<h3 class="font-bold text-red mb-6 text-3xl">' . esc_html($year) . '</h3>'; ?>
                                                                        <?php if ($excerpt) echo '<div class="font-bold mb-4">' . esc_html($excerpt) . '</div>'; ?>
                                                                        <?php if ($content) echo '<div class="prose prose-lg prose-li:my-0">' . wp_kses_post($content) . '</div>'; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>

                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <svg class="timeline-love-separator absolute left-[30px] md:left-1/2 bottom-0 -translate-x-[1px] translate-y-1/2 z-20" width="64" height="130" viewBox="0 0 64 130" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 0C1 27 10.5514 49.907 22.5 65C41.5 89 60 90.5 61.5 81C63 71.5 54.6774 67.4257 52 69.3186C47.5 72.5 55 78 60 69C65 60 63.5 47 52 46.5C40.5 46 29.0575 56.9302 22 65.5C15 74 1 87.5 1 130" stroke="#86774F" stroke-width="2" />
                                </svg>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php } wp_reset_postdata(); ?>

                <!-- Background Parallax Images -->
                <?php if ($the_query->have_posts()) { ?>
                    <div id="entriesBackground" class="h-screen inset-0 fixed z-0 pointer-events-none">
                        <?php while ($the_query->have_posts()) : $the_query->the_post();
                            $id = get_the_ID();
                            $period = get_field('period', $id);
                            $background = $period['background'];
                            $background_color = $background['background_color'];
                            $background_image = $background['background_image'];
                            $bg_style = '';
                            if ($background_color) {
                                $bg_style = 'background-color: ' . $background_color;
                            }
                        ?>
                            <div id="img-<?php echo esc_attr($id); ?>" class="section-background" style="<?php echo esc_attr($bg_style); ?>">
                                <?php if ($background_image) : ?>
                                    <div class="h-screen w-full grayscale">
                                        <img class="w-full h-full object-cover" src="<?php echo esc_url($background_image['url']); ?>" alt="">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                        <div class="absolute inset-0 bg-white bg-opacity-[.85]"></div>
                    </div>
                <?php } wp_reset_postdata(); ?>
            </div>
        </div>
    </div>

</main>

<?php
get_footer();
