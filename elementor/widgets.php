<?php
/**
 * Description.
 *
 * @package WordPress
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

use AazzTech\FindBiz\DirHelper;
use AazzTech\FindBiz\Helper;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

//Heading Pro
class FindBiz_Heading extends Widget_Base
{

    public function get_name()
    {
        return 'heading_pro section-title';
    }

    public function get_title()
    {
        return __('Heading Pro', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-t-letter';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['heading', 'pro', 'Heading Pro'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'heading_pro',
            [
                'label' => __('Title & Subtitle', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'findbiz-core'),
                'default'     => __('Add Your Heading Text Here', 'findbiz-core'),
                'description' => esc_html('Use tag "<span>" for highlighting the text. eg. Explore <span>Popular</span> Category'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label'   => __('Link', 'findbiz-core'),
                'type'    => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label'   => __('HTML Tag', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'   => __('Subtitle', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your subtitle', 'findbiz-core'),
                'default'     => __('Add Your subtitle Text Here', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'align',
            [
                'label'   => __('Alignment', 'findbiz-core'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'  => __('Subtitle Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings   = $this->get_settings_for_display();
        $title      = $settings['title'];
        $subtitle   = $settings['subtitle'] ? '<p>' . $settings['subtitle'] . '</p>' : '';
        $header     = $settings['header_size'];
        $link       = $settings['link']['url'];
        $target     = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow   = $settings['link']['nofollow'] ? 'rel="nofollow"' : '';
        $title_attr = $settings['link']['custom_attributes'];

        if ($link) {
            $title = sprintf('<a href="%s" %s %s title="%s" >%s</a>', $link, $target, $nofollow, $title_attr, $title);
        }

        echo sprintf('<%1$s> %2$s </%1$s> %3$s', $header, $title, $subtitle);
    }
}

//Accordion
class FindBiz_Accordion extends Widget_Base
{

    public function get_name()
    {
        return 'accordion';
    }

    public function get_title()
    {
        return __('Faq', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-accordion';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['accordion', 'tabs', 'faq'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Faq', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'element_title',
            [
                'label'   => __('Element title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter element title', 'findbiz-core'),
                'default'     => __("Listing FAQ's", 'findbiz-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'   => __('Title & Content', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Accordion Title', 'findbiz-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label'      => __('Content', 'findbiz-core'),
                'type'       => Controls_Manager::TEXTAREA,
                'default'    => __('Accordion Content', 'findbiz-core'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'   => __('Accordion Items', 'findbiz-core'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title'   => __('How to open an account?', 'findbiz-core'),
                        'tab_content' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'findbiz-core'),
                    ],
                    [
                        'tab_title'   => __('How to add listing?', 'findbiz-core'),
                        'tab_content' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'findbiz-core'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => __('Title', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'findbiz-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.atbdp-accordion .dacc_single h3 a' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label'     => __('Active Color', 'findbiz-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.atbdp-accordion .dacc_single h3 a.active' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_content',
            [
                'label' => __('Content', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Color', 'findbiz-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.atbdp-accordion .dacc_single .dac_body' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings      = $this->get_settings_for_display();
        $accordions    = $settings['tabs'];
        $section_title = $settings['element_title']; ?>
        <div class="faq-contents">
            <div class="atbd_content_module atbd_faqs_module">
                <?php if ($section_title) { ?>
                    <div class="atbd_content_module__tittle_area">
                        <div class="atbd_area_title">
                            <h4>
                                <span class="la la-question-circle"></span>
                                <?php echo esc_attr($section_title); ?>
                            </h4>
                        </div>
                    </div>
                <?php
                } ?>
                <div class="atbdb_content_module_contents">
                    <div class="atbdp-accordion findbiz_accordion">
                        <?php
                        if ($accordions) {
                            foreach ($accordions as $accordion) {
                                $title = $accordion['tab_title'];
                                $desc  = $accordion['tab_content']; ?>
                                <div class="dacc_single">
                                    <h3 class="faq-title">
                                        <a href="#"><?php echo esc_attr($title); ?></a>
                                    </h3>
                                    <p class="dac_body"><?php echo esc_attr($desc); ?></p>
                                </div>
                        <?php
                            }
                            wp_reset_postdata();
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

//Add listing form
class FindBiz_findbiz_Form extends Widget_Base
{
    public function get_name()
    {
        return 'add_listing_form';
    }

    public function get_title()
    {
        return __('Add Listing Form', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-post-excerpt';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['Listing form', 'form', 'add listing'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'add_listing_form',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'form_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        echo do_shortcode('[directorist_add_listing]');
    }
}

//Author Profile
class FindBiz_Profile extends Widget_Base
{
    public function get_name()
    {
        return 'author_profile';
    }

    public function get_title()
    {
        return __('Author Profile', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-site-identity';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['profile', 'author', 'author profile'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'author_profile',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'profile_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'profile_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="findbiz-author"> <?php echo do_shortcode('[directorist_author_profile]'); ?> </div>
        <?php
    }
}

//Blog Posts
class FindBiz_Blogs extends Widget_Base
{
    public function get_name()
    {
        return 'blog_posts';
    }

    public function get_title()
    {
        return __('Blogs', 'findbiz-core');
    }

    public function get_icon()
    {
        return '  eicon-post';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['blog', 'post', 'blog post'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'blog_posts',
            [
                'label' => __('Blog Posts', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'post_count',
            [
                'label'   => __('Number of Posts to Show:', 'findbiz-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => __('Order by', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'ID'            => esc_html__(' Post ID', 'findbiz-core'),
                    'author'        => esc_html__(' Author', 'findbiz-core'),
                    'title'         => esc_html__(' Title', 'findbiz-core'),
                    'name'          => esc_html__(' Post name (post slug)', 'findbiz-core'),
                    'type'          => esc_html__(' Post type (available since Version 4.0)', 'findbiz-core'),
                    'date'          => esc_html__(' Date', 'findbiz-core'),
                    'modified'      => esc_html__(' Last modified date', 'findbiz-core'),
                    'rand'          => esc_html__(' Random order', 'findbiz-core'),
                    'comment_count' => esc_html__(' Number of comments', 'findbiz-core')
                ],
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label'   => __('Order post', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC'  => esc_html__(' ASC', 'findbiz-core'),
                    'DESC' => esc_html__(' DESC', 'findbiz-core'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings   = $this->get_settings_for_display();
        $post_count = $settings['post_count'];
        $order_by   = $settings['order_by'];
        $order_list = $settings['order_list'];

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => esc_attr($post_count),
            'order'          => esc_attr($order_list),
            'orderby '       => esc_attr($order_by)
        );

        $posts = new WP_Query($args); ?>
        <div class="blog-posts row" data-uk-grid>
            <?php while ($posts->have_posts()) {
                $posts->the_post(); ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog-posts__single">
                        <?php the_post_thumbnail('findbiz_blog_grid'); ?>
                        <div class="blog-posts__single__contents">
                            <?php the_title(sprintf('<h4><a href="%s">', get_the_permalink()), '</a></h4>'); ?>
                            <ul>
                                <li><?php echo Helper::time(); ?></li>
                                <?php Helper::categories(); ?>
                            </ul>
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            wp_reset_postdata(); ?>
        </div>
        <?php
    }
}

//Checkout
class FindBiz_Checkout extends Widget_Base
{
    public function get_name()
    {
        return 'checkout';
    }

    public function get_title()
    {
        return __('Checkout', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-product-price';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['checkout', 'payment', 'checkout payment'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'checkout',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'checkout_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'checkout_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="findbiz-directorist_checkout">
            <?php echo do_shortcode('[directorist_checkout]'); ?>
        </div>
        <?php
    }
}

//Contact form 7
class FindBiz_ContactForm extends Widget_Base
{
    public function get_name()
    {
        return 'contact_form';
    }

    public function get_title()
    {
        return __('Contact Form', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-form-horizontal';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['contact', 'form', 'contact form'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'contact_form',
            [
                'label' => __('Contact Form', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __('Form Title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter form title', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'contact_form_id',
            [
                'label'   => __('Select Contact Form', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => DirHelper::cf7_names(),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $title           = $settings['title'];
        $contact_form_id = $settings['contact_form_id'];

        if ($contact_form_id) { ?>
            <div class="contact-wrapper">
                <?php if ($title) { ?>
                    <div class="contact-wrapper__title">
                        <h4><?php echo esc_attr($title); ?></h4>
                    </div>
                <?php
                } ?>
                <div class="contact-wrapper__fields">
                    <?php echo do_shortcode('[contact-form-7 id="' . intval(esc_attr($contact_form_id)) . '" ]'); ?>
                </div>
            </div>
            <?php
        }
    }
}

//Contact items
class FindBiz_ContactItems extends Widget_Base
{
    public function get_name()
    {
        return 'contact_items';
    }

    public function get_title()
    {
        return __('Contact Items', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-bullet-list';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['address', 'list', 'item', 'contact items'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'contact_items',
            [
                'label' => __('Contact Items', 'findbiz-core'),
            ]
        );


        $repeater = new Repeater();

        $repeater->add_control(
            'fontawesome',
            [
                'label' => __('Font-Awesome', 'findbiz-core'),
                'type'  => Controls_Manager::ICON,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'      => __('Content', 'findbiz-core'),
                'type'       => Controls_Manager::TEXTAREA,
                'default'    => __('Enter your address', 'findbiz-core'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'   => __('Add New Items', 'findbiz-core'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'fontawesome' => 'fa fa-map',
                        'title'       => __('Enter your address', 'findbiz-core'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings  = $this->get_settings_for_display();
        $addresses = $settings['tabs'];
        ?>
        <div class="contact_info_list_wrapper">
            <?php if ($addresses) { ?>
                <div class="contact_info_list">
                    <ul>
                        <?php
                        foreach ($addresses as $address) {
                            $title = $address['title'];
                            $icon  = $address['fontawesome'];
                            if ($title) { ?>
                                <li>
                                    <p><span class="<?php echo esc_attr($icon); ?>"></span></p>
                                    <p class="contact-details">
                                        <span class="contact-details__title"><?php echo esc_attr($title); ?></span>
                                    </p>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            <?php
            } ?>
        </div>
    <?php
    }
}

//Counter
class FindBiz_Counter extends Widget_Base
{
    public function get_name()
    {
        return 'counter';
    }

    public function get_title()
    {
        return __('Counter', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-counter';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['count', 'counter', 'count down'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_counter',
            [
                'label' => __('Counter', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'number',
            [
                'label'   => __('Number', 'findbiz-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 0,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'suffix',
            [
                'label'   => __('Number Suffix', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'label',
            [
                'label'   => __('Title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $number   = $settings['number'];
        $suffix   = $settings['suffix'];
        $title    = $settings['label']; ?>
        <div class="list-unstyled counter-items">
            <div>
                <p>
                    <span class="count_up"><?php echo esc_attr($number); ?></span>
                    <?php echo esc_attr($suffix); ?>
                </p>
                <span><?php echo esc_attr($title); ?></span>
            </div>
        </div>
    <?php
    }
}

//Call To Action
class FindBiz_CTA extends Widget_Base
{

    public function get_name()
    {
        return 'call_to_action';
    }

    public function get_title()
    {
        return __('Call To Action', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-call-to-action';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['cta', 'call to action', 'action'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'call_to_action',
            [
                'label' => __('Call To Action', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'Are you a Business Providers or Service Seekers?'
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'   => __('Subtitle', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'Post your business or needs today.'
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label'   => __('Button Label', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'Add Your Listing'
            ]
        );

        $this->add_control(
            'link',
            [
                'label'   => __('Button Link', 'findbiz-core'),
                'type'    => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_color',
            [
                'label'  => __('Section BG Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-wrapper.cta--dark' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-wrapper .cta-content h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'  => __('Subtitle Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-wrapper .cta-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title    = $settings['title'];
        $subtitle = $settings['subtitle'];
        $btn_text = $settings['btn_text'];

        $link       = $settings['link']['url'];
        $target     = $settings['link']['is_external'];
        $nofollow   = $settings['link']['nofollow'];
        $title_attr = $settings['link']['custom_attributes']; ?>

        <div class="cta-wrapper cta--dark">
            <div class="cta-content">
                <h3><?php echo wp_kses_post($title); ?></h3>
                <p><?php echo esc_attr($subtitle); ?></p>
            </div>
            <?php if ($btn_text) { ?>
                <div class="cta-btn">
                    <a class="btn btn-primary" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow); ?>" title="<?php echo esc_attr($title_attr); ?>">
                        <?php echo esc_attr($btn_text); ?>
                    </a>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

//Dashboard
class FindBiz_Dashboard extends Widget_Base
{
    public function get_name()
    {
        return 'dashboard';
    }

    public function get_title()
    {
        return __('Dashboard', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-dashboard';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['dashboard', 'author dashboard'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'dashboard',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dashboard_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dashboard_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="findbiz-directorist_user_dashboard">
            <?php echo do_shortcode('[directorist_user_dashboard]'); ?>
        </div>
        <?php
    }
}

//Feature Box
class FindBiz_FeatureBox extends Widget_Base
{
    public function get_name()
    {
        return 'feature_boxes';
    }

    public function get_title()
    {
        return __('Feature Box', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-post-list';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['feature', 'feature box', 'all features'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'feature_box',
            [
                'label' => __('Feature Box', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => [
                    'style-one' => esc_html__('Style 1', 'findbiz-core'),
                    'style-two' => esc_html__('Style 2', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'number',
            [
                'label'     => __('Feature Number', 'findbiz-core'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => 10,
                'step'      => 1,
                'condition' => [
                    'style' => 'style-one'
                ]
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => __('Type', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon'  => esc_html__('Icon Type', 'findbiz-core'),
                    'image' => esc_html__('Image Type', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'     => __('Font-Awesome', 'findbiz-core'),
                'type'      => Controls_Manager::ICON,
                'condition' => [
                    'type' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => __('Choose Image', 'findbiz-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'   => __('Title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your description', 'findbiz-core'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'feature_box_style',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_icon_align',
            [
                'label'   => __('Icon & Image Alignment', 'findbiz-core'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .card-single-content .service-icon i' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_desc_align',
            [
                'label'   => __('Title & Description Alignment', 'findbiz-core'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .card-single-content h4, {{WRAPPER}} .card-single-content p' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title    = $settings['title'];
        $desc     = $settings['desc'];
        $type     = $settings['type'];
        $image    = $settings['image'];
        $icon     = $settings['icon'];
        $number   = $settings['number'];
        $style    = $settings['style'];
        ?>

        <div class="service-cards" id="<?php echo esc_attr($style); ?>">
            <div class="card-single">
                <div class="card-single-content">
                    <?php if ('icon' == $type) { ?>
                        <div class="service-icon">
                            <i class="<?php echo esc_attr($icon); ?>"></i>
                        </div>
                    <?php } else { ?>
                        <div class="service-icon">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo Helper::image_alt($image['id']) ?>">
                        </div>
                    <?php } ?>
                    <h4><?php echo esc_attr($title) ?></h4>
                    <p><?php echo esc_attr($desc) ?></p>
                    <?php if ('style-one' == $style) { ?>
                        <span class="service-count"><?php echo esc_attr('0' . $number); ?></span>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
}

//Feature section
class FindBiz_FeatureSection extends Widget_Base
{
    public function get_name()
    {
        return 'feature_section';
    }

    public function get_title()
    {
        return __('Feature Section', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-banner';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['section', 'feature section'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'feature_section',
            [
                'label' => __('Feature Section', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => [
                    'style-one'   => esc_html__('Style 1', 'findbiz-core'),
                    'style-two'   => esc_html__('Style 2', 'findbiz-core'),
                    'style-three' => esc_html__('Style 3', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'findbiz-core'),
                'default'     => 'See how it works'
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'   => __('Description', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your description', 'findbiz-core'),
                'default'     => 'The best place for people and businesses to outsource tasks.'
            ]
        );

        $this->add_control(
            'btn',
            [
                'label'   => __('Video Button Label', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'style' => 'style-one'
                ]
            ]
        );

        $this->add_control(
            'url',
            [
                'label'         => __('Link', 'findbiz-core'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __('https://your-link.com', 'findbiz-core'),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
                'condition' => [
                    'style' => ['style-one', 'style-two'],
                ]
            ]
        );

        $this->add_control(
            'img',
            [
                'label'   => __('Right Side Image', 'findbiz-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title    = $settings['title'];
        $desc     = $settings['desc'];
        $btn      = $settings['btn'];
        $url      = $settings['url'] ? $settings['url']['url'] : '';
        $img      = $settings['img'];
        $style    = $settings['style'];
        ?>
        
        <?php if ('style-one' == $style) { ?>
            <div class="service-process">
                <div class="process-desc">
                    <h2><?php echo wp_kses_post($title); ?></h2>
                    <p><?php echo wp_kses_post($desc); ?></p>
                    <p class="play--btn">
                    <span class="">
                        <i class="fas fa-play"></i>
                    </span>
                        <a href="<?php echo esc_url($url); ?>" class="stretched-link video-iframe"><?php echo esc_attr($btn); ?></a>
                    </p>
                </div>
                <div class="process-img"><img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo Helper::image_alt($img['id']); ?>"></div>
            </div>
        <?php } elseif ('style-two' == $style) { ?>
            <div class="intro-video">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <h1><?php echo wp_kses_post($title); ?></h1>
                            <p class="col-md-10"><?php echo wp_kses_post($desc); ?></p>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="card-video">
                                <figure>
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo Helper::image_alt($img['id']); ?>">
                                    <figcaption>
                                        <a href="<?php echo esc_url($url); ?>" class="play--btn video-iframe">
                                            <span class=""><i class="fa fa-play"></i></span>
                                        </a>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <section class="intro-img">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1><?php echo wp_kses_post($title) ?></h1>
                            <p><?php echo wp_kses_post($desc) ?></p>
                        </div>
                        <div class="col-lg-6">
                            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr(Helper::image_alt($img['id'])); ?>" class="img-full">
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}

//Listings
class FindBiz_Listings extends Widget_Base
{
    public function get_name()
    {
        return 'listings';
    }

    public function get_title()
    {
        return __('All Listings', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['listings', 'all listings'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'listings',
            [
                'label' => __('All Listings', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'findbiz-core'),
                    'list' => esc_html__('List View', 'findbiz-core'),
                    'map' => esc_html__('Map View', 'findbiz-core'),
                    'listings_with_map' => esc_html__('Listings With Map View', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
                'condition' => [
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'findbiz-core'),
                    '4' => esc_html__('4 Items / Row', 'findbiz-core'),
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'listings_with_map',
                ]
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label' => __('Map Height', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 300,
                'max' => 1980,
                'default' => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]

        );

        $this->add_control(
            'zoom_level',
            [
                'label'   => __('Map Zoom Level', 'findbiz-core'),
                'type'    => Controls_Manager::SLIDER ,
                'range' => [
					'px' => [
						'min' => 1,
						'max' => 18,
						'step' => 1,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'condition' => [
                    'layout' => 'map'
                ]
            ]
        );

        $this->add_control(
            'header',
            [
                'label' => __('Show Header?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'findbiz-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'findbiz-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'header' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'     => __('Show Filter Button?', 'findbiz-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'header' => 'yes',
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'preview',
            [
                'label' => __('Show Preview Image?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );


        $this->add_control(
            'listings_count',
            [
                'label' => __('Number of Listings to Show:', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'cat',
            [
                'label' => __('Specify Categories', 'findbiz-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => DirHelper::categories(),
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => __('Specify Tags', 'findbiz-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => DirHelper::tags(),
            ]
        );

        $this->add_control(
            'location',
            [
                'label' => __('Specify Locations', 'findbiz-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => DirHelper::locations(),
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => __('Show Featured Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label' => __('Show Popular Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'findbiz-core'),
                    'date' => esc_html__(' Date', 'findbiz-core'),
                    'price' => esc_html__(' Price', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'findbiz-core'),
                    'desc' => esc_html__(' DESC', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-listing-single .directorist-listing-single__info .directorist-listing-title a, {{WRAPPER}} .directorist-archive-grid-view .directorist-listing-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $default_types   = $settings['default_types'];
        $types           = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $preview         = $settings['preview'] ? $settings['preview'] : 'no';
        $layout          = $settings['layout'];
        $zoom_level      = $settings['zoom_level'];
        $map_height      = $settings['map_height'];
        $header          = $settings['header'];
        $title           = $settings['title'];
        $filter          = $settings['filter'];
        $user            = $settings['user'];
        $row             = $settings['row'];
        $rows             = $settings['rows'];
        $listings_count  = $settings['listings_count'];
        $cat             = $settings['cat'] ? implode($settings['cat'], []) : '';
        $tag             = $settings['tag'] ? implode($settings['tag'], []) : '';
        $location        = $settings['location'] ? implode($settings['location'], []) : '';
        $featured        = $settings['featured'];
        $popular         = $settings['popular'];
        $order_by        = $settings['order_by'];
        $order_list      = $settings['order_list'];
        $show_pagination = $settings['show_pagination'];
        ?>
        
        <?php echo ( 'listings_with_map' === $layout ) ? '<input type="hidden" id="listing-listings_with_map">' : ''; ?>

        <div id="<?php echo esc_attr("listing-" . $layout); ?>">
            <?php echo do_shortcode(' [directorist_all_listing view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($listings_count) . '" category="' . esc_attr($cat) . '" tag="' . esc_attr($tag) . '" location="' . esc_attr($location) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" advanced_filter="'.$filter.'" columns="' . esc_attr($row) . '" listings_with_map_columns="' . esc_attr($rows) . '" show_pagination="' . esc_attr($show_pagination) . '" map_height="' . $map_height . '" map_zoom_level="'.$zoom_level.'" display_preview_image="'.$preview.'" logged_in_user_only="' . esc_attr($user) . '" directory_type="' . esc_attr($types) . '" default_directory_type="' . esc_attr($default_types) . '"]'); ?>
        </div>

        <?php
    }
}

//Registration
class FindBiz_Registration extends Widget_Base
{
    public function get_name()
    {
        return 'registration';
    }

    public function get_title()
    {
        return __('Registration Form', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' fas fa-user-plus';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'Registration',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'Registration_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'Registration_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="findbiz-directorist_custom_registration"><?php echo do_shortcode('[directorist_custom_registration]'); ?></div>
        <?php
    }
}

//Login
class FindBiz_Login extends Widget_Base
{
    public function get_name()
    {
        return 'login';
    }

    public function get_title()
    {
        return __('Login Form', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-lock-user';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'login',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'login_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="findbiz-directorist_user_login">
            <?php echo do_shortcode('[directorist_user_login]'); ?>
        </div>
        <?php
    }
}

//Transaction
class FindBiz_Transaction extends Widget_Base
{
    public function get_name()
    {
        return 'transaction';
    }

    public function get_title()
    {
        return __('Transaction', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-sync';
    }

    public function get_keywords()
    {
        return ['transaction'];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }


    protected function _register_controls()
    {
        $this->start_controls_section(
            'transaction',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'transaction_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'transaction_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="findbiz-directorist_transaction_failure">
            <?php echo do_shortcode('[directorist_transaction_failure]'); ?>
        </div>
        <?php
    }
}

//Logos
class FindBiz_Logos extends Widget_Base
{
    public function get_name()
    {
        return 'logos';
    }

    public function get_title()
    {
        return __('Logos Carousel', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-carousel';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['logo', 'logos', 'carousel',];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'logos',
            [
                'label' => __('Logos', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'     => esc_html__('Grid', 'findbiz-core'),
                    'carousel' => esc_html__('Carousel', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'clients_logo',
            [
                'label'   => __('Add Logos', 'findbiz-core'),
                'type'    => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $style    = $settings['style'];
        $logos    = $settings['clients_logo'];

        if ('grid' == $style) { ?>
            <div class="clients-logo">
                <div class="clients-logo-grid">
                    <?php
                    if ($logos) {
                        foreach ($logos as $logo) { ?>
                            <div><img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo Helper::image_alt($logo['id']); ?>"></div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        } else { ?>
            <div class="logo-carousel owl-carousel">
                <?php
                if ($logos) {
                    foreach ($logos as $logo) { ?>
                        <div class="carousel-single">
                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo Helper::image_alt($logo['id']); ?>">
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }
    }
}

//Payment
class FindBiz_Payment extends Widget_Base
{
    public function get_name()
    {
        return 'payment';
    }

    public function get_title()
    {
        return __('Payment', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-product-breadcrumbs';
    }

    public function get_keywords()
    {
        return ['payment',];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'payment',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'payment_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'payment_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="findbiz-payment-receipt">
            <?php echo do_shortcode('[directorist_payment_receipt]'); ?>
        </div>
        <?php
    }
}

//Pricing plan
class FindBiz_PricingPlan extends Widget_Base
{
    public function get_name()
    {
        return 'pricing_plan';
    }

    public function get_title()
    {
        return __('Pricing Plan', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' fas fa-dollar-sign';
    }

    public function get_keywords()
    {
        return ['pricing', 'price',];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'pricing_plan',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pp_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pp_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        echo do_shortcode('[directorist_pricing_plans]');
    }
}

//Hero area
class FindBiz_SearchForm extends Widget_Base
{

    public function get_name()
    {
        return 'search_form section-padding';
    }

    public function get_title()
    {
        return __('Search Form', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-device-desktop';
    }

    public function get_keywords()
    {
        return ['search-form', 'form', 'hero area'];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'hero_area',
            [
                'label' => __('Search Form', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'logged_in',
            [
                'label'   => __('Show Only For Logging User?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'title_subtitle',
            [
                'label'   => __('Show Title & Subtitle?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'findbiz-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your title', 'findbiz-core'),
                'default'     => __('Explore Trusted Business', 'findbiz-core'),
                'condition'   => [
                    'title_subtitle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'       => __('Subtitle', 'findbiz-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your subtitle', 'findbiz-core'),
                'default'     => __('Get notified about services that match your requirement', 'findbiz-core'),
                'condition'   => [
                    'title_subtitle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'search',
            [
                'label'       => __('Search Button Label', 'findbiz-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Enter search button label', 'findbiz-core'),
                'default'     => __('Search', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'more_btn',
            [
                'label'   => __('Advance Search Field?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'reset',
            [
                'label'   => __('Reset Button Label', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Reset',
                'condition'   => [
                    'more_btn' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'apply',
            [
                'label'   => __('Apply Button Label', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Apply',
                'condition'   => [
                    'more_btn' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'popular_cat',
            [
                'label'   => __('Show Popular Category?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-search-top__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'  => __('Subtitle Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-search-top__subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label'  => __('Tab Text Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-listing-type-selection .directorist-listing-type-selection__item a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_bg_color',
            [
                'label'  => __('Tab BG Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-listing-type-selection .directorist-listing-type-selection__item a.directorist-listing-type-selection__link--current:before' => 'border-left-color: {{VALUE}};',
                    '{{WRAPPER}} .directorist-listing-type-selection .directorist-listing-type-selection__item a.directorist-listing-type-selection__link--current' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_box',
            [
                'label'  => __('Search Box Border Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-search-form-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings       = $this->get_settings_for_display();
        $title_subtitle = $settings['title_subtitle'];
        $title          = $settings['title'];
        $subtitle       = $settings['subtitle'];
        $search         = $settings['search'];
        $more_btn       = $settings['more_btn'];
        $reset	        = $settings['reset'];
        $apply	        = $settings['apply'];
        $popular_cat    = $settings['popular_cat'];
        $logged_in	    = $settings['logged_in'];
        $default_types	= $settings['default_types'];
        $types          = $settings['types'] ? implode( ',', $settings['types'] ) : ''; ?>

        <div class="search-form-wrapper search-form-wrapper--one">
            <?php echo do_shortcode( '[directorist_search_listing show_title_subtitle="'.$title_subtitle.'" search_bar_title="'.$title.'" search_bar_sub_title="'.$subtitle.'" search_button="yes" search_button_text="'.$search.'" more_filters_button="'.$more_btn.'" more_filters_text="" reset_filters_button="yes" apply_filters_button="yes" reset_filters_text="'.$reset.'" apply_filters_text="'.$apply.'" more_filters_display="overlapping" logged_in_user_only="'.$logged_in.'" directory_type="'.$types.'" default_directory_type="'.$default_types.'" show_popular_category="'.$popular_cat.'"]' ); ?>
        </div>
        <?php
    }
}

//Search result
class FindBiz_SearchResult extends Widget_Base
{
    public function get_name()
    {
        return 'search_result';
    }

    public function get_title()
    {
        return __('Search Result', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-search-results';
    }

    public function get_keywords()
    {
        return ['result', 'search'];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'listings',
            [
                'label' => __('Search Results', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'findbiz-core'),
                    'list' => esc_html__('List View', 'findbiz-core'),
                    'map' => esc_html__('Map View', 'findbiz-core'),
                    'listings_with_map' => esc_html__('Listings With Map View', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
                'condition' => [
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'findbiz-core'),
                    '4' => esc_html__('4 Items / Row', 'findbiz-core'),
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'grid',
                ]
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'listings_with_map',
                ]
            ]
        );

        $this->add_control(
            'preview',
            [
                'label' => __('Show Preview Image?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label' => __('Map Height', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 300,
                'max' => 1980,
                'default' => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]
        );

        $this->add_control(
            'zoom_level',
            [
                'label'   => __('Map Zoom Level', 'findbiz-core'),
                'type'    => Controls_Manager::SLIDER ,
                'range' => [
					'px' => [
						'min' => 1,
						'max' => 18,
						'step' => 1,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'condition' => [
                    'layout' => 'map',
                ]
            ]
        );

        $this->add_control(
            'header',
            [
                'label' => __('Show Header?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'findbiz-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'findbiz-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'header' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'     => __('Show Filter Button?', 'findbiz-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'header' => 'yes',
                    'layout!' => 'listings_with_map',
                ]
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'listings_count',
            [
                'label' => __('Number of Listings to Show:', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => __('Show Featured Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label' => __('Show Popular Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'findbiz-core'),
                    'date' => esc_html__(' Date', 'findbiz-core'),
                    'price' => esc_html__(' Price', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'findbiz-core'),
                    'desc' => esc_html__(' DESC', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $default_types   = $settings['default_types'];
        $types           = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $preview         = $settings['preview'] ? $settings['preview'] : 'no';
        $layout          = $settings['layout'];
        $zoom_level      = $settings['zoom_level'];
        $map_height      = $settings['map_height'];
        $header          = $settings['header'];
        $title           = $settings['title'];
        $filter          = $settings['filter'];
        $user            = $settings['user'];
        $row             = $settings['row'];
        $rows            = $settings['rows'];
        $listings_count  = $settings['listings_count'];
        $featured        = $settings['featured'];
        $popular         = $settings['popular'];
        $order_by        = $settings['order_by'];
        $order_list      = $settings['order_list'];
        $show_pagination = $settings['show_pagination'];

        echo ( 'listings_with_map' === $layout ) ? '<input type="hidden" id="listing-listings_with_map">' : '';
        echo do_shortcode(' [directorist_search_result view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($listings_count) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" advanced_filter="'.$filter.'" columns="' . esc_attr($row) . '" show_pagination="' . esc_attr($show_pagination) . '" map_height="' . $map_height . '" map_zoom_level="'.$zoom_level.'" display_preview_image="'.$preview.'" logged_in_user_only="' . esc_attr($user) . '" directory_type="' . esc_attr($types) . '" default_directory_type="' . esc_attr($default_types) . '" listings_with_map_columns="' . esc_attr($rows) . '"]');
    }
}

//Categories
class FindBiz_Categories extends Widget_Base
{
    public function get_name()
    {
        return 'categories';
    }

    public function get_title()
    {
        return __('All Categories', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-theme-builder';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['categories', 'all categories', 'listing categories'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'categories',
            [
                'label' => __('All Categories', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'logged_in',
            [
                'label'   => __('Show Only For Logged In User?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'grid'    => esc_html__('Grid View', 'findbiz-core'),
                    'list' => esc_html__('List View', 'findbiz-core'),
                    'icon' => esc_html__('Icon View', 'findbiz-core'),
                    'carousel' => esc_html__('Carousel View', 'findbiz-core'),
                    'icon_carousel' => esc_html__('Icon Carousel View', 'findbiz-core'),
                ],
                'default' => 'grid',
            ]
        );

        $this->add_control(
            'row',
            [
                'label'   => esc_html__('Categories Per Row', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__('6 Items / Row', 'findbiz-core'),
                    '4' => esc_html__('4 Items / Row', 'findbiz-core'),
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'default' => '3',
            ]
        );

        $this->add_control(
            'number_cat',
            [
                'label'   => __('Number of categories to Show:', 'findbiz-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
                'default' => 6,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => esc_html__('Order by', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id'    => esc_html__(' Cat ID', 'findbiz-core'),
                    'count' => esc_html__('Listing Count', 'findbiz-core'),
                    'name'  => esc_html__('Category name (A-Z)', 'findbiz-core'),
                    'slug'  => esc_html__('Select Category', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'slug',
            [
                'label'     => esc_html__('Select Categories', 'findbiz-core'),
                'type'      => Controls_Manager::SELECT2,
                'multiple'  => true,
                'options'   => DirHelper::categories(),
                'condition' => [
                    'order_by' => 'slug'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label'   => esc_html__('Categories Order', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
                    'asc'  => esc_html__(' ASC', 'findbiz-core'),
                    'desc' => esc_html__(' DESC', 'findbiz-core'),
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'listings_cats',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #directorist.atbd_wrapper .atbd_all_categories .atbd_category_single:not(.atbd_category_no_image) .cat-info .cat-name, {{WRAPPER}} #directorist.atbd_wrapper.atbdp-categories.atbdp-text-list .atbd_category_wrapper a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'  => __('Subtitle Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .atbd_category_single figure figcaption .cat-box .cat-info span, {{WRAPPER}} #directorist.atbd_wrapper .atbd_all_categories .atbd_category_single:not(.atbd_category_no_image) .cat-info .cat-count span, {{WRAPPER}} .findbiz-cat-view-icon_carousel #directorist.atbd_wrapper .atbd_all_categories .atbd_category_single:not(.atbd_category_no_image) figure figcaption .cat-box .cat-info .cat-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings      = $this->get_settings_for_display();
        $default_types = $settings['default_types'];
        $types         = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $slug          = $settings['slug'] ? implode( ',', $settings['slug'] ) : '';
        $views         = $settings['view'];
        $view          = ('grid' == $views) || ('list' == $views) ? $views : 'grid';
        $order_by      = $settings['order_by'];
        $order         = $settings['order_list'];
        $columns       = $settings['row'];
        $number_cat    = $settings['number_cat'];
        $logged_in     = $settings['logged_in'];

        ( 'icon_carousel' === $views) || ( 'carousel' === $views) ? add_action('findbiz_category_column', function () { echo esc_html('-carousel'); } ) : '';
        ( 'icon' === $views) || ( 'icon_carousel' === $views) ? add_filter('findbiz_category_image', '__return_false') : '';
        ( 'icon' != $views) && ( 'icon_carousel' != $views) ? add_filter('findbiz_category_icon', '__return_false') : '';
        ( 'icon' === $views) || ( 'grid' === $views) || ( 'list' === $views) ? add_filter('findbiz_category_carousel', '__return_false') : '';
        ?>
        <div class="findbiz-cat-view-<?php echo $views; ?>">
            <?php echo do_shortcode( '[directorist_all_categories view="'.$view.'" orderby="'.$order_by.'" order="'.$order.'" cat_per_page="'.$number_cat.'" columns="'.$columns.'" slug="'.$slug.'" logged_in_user_only="'.$logged_in.'" directory_type="'.$types.'" default_directory_type="'.$default_types.'"]' ); ?>
        </div>
        <?php
    }
}

//Locations
class FindBiz_Locations extends Widget_Base
{
    public function get_name()
    {
        return 'locations';
    }

    public function get_title()
    {
        return __('All Locations', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-map-pin';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['locations', 'all location', 'listing locations'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'locations',
            [
                'label' => __('Listing Locations', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'logged_in',
            [
                'label'   => __('Show Only For Logged In User?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'grid'    => esc_html__('Grid View', 'findbiz-core'),
                    'list' => esc_html__('List View', 'findbiz-core'),
                ],
                'default' => 'grid',
            ]
        );

        $this->add_control(
            'row',
            [
                'label'   => esc_html__('Categories Per Row', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '4' => esc_html__('4 Items / Row', 'findbiz-core'),
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'default' => '2',
            ]
        );

        $this->add_control(
            'number_loc',
            [
                'label'   => __('Number of locations to Show:', 'findbiz-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
                'default' => 4,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => esc_html__('Order by', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id'    => esc_html__('Location ID', 'findbiz-core'),
                    'count' => esc_html__('Listing Count', 'findbiz-core'),
                    'name'  => esc_html__('Location name (A-Z)', 'findbiz-core'),
                    'slug'  => esc_html__('Select Location', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'slug',
            [
                'label'     => esc_html__('Select Locations', 'findbiz-core'),
                'type'      => Controls_Manager::SELECT2,
                'multiple'  => true,
                'options'   => DirHelper::locations(),
                'condition' => [
                    'order_by' => 'slug'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label'   => esc_html__('Locations Order', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
                    'asc'  => esc_html__(' ASC', 'findbiz-core'),
                    'desc' => esc_html__(' DESC', 'findbiz-core'),
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'listings_cats',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #directorist.atbd_wrapper .atbd_location_grid_wrap .atbd_location_grid:not(.atbd_location_grid-default) figure figcaption h3, {{WRAPPER}} .atbdp-text-list .atbd_category_wrapper a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'  => __('Subtitle Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .atbd_location_grid .listing-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings      = $this->get_settings_for_display();
        $default_types = $settings['default_types'];
        $types         = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $slug          = $settings['slug'] ? implode( ',', $settings['slug'] ) : '';
        $views         = $settings['view'];
        $order_by      = $settings['order_by'];
        $order         = $settings['order_list'];
        $columns       = $settings['row'];
        $number_loc    = $settings['number_loc'];
        $logged_in     = $settings['logged_in'];
        
        echo do_shortcode( '[directorist_all_locations view="'.$views.'" orderby="'.$order_by.'" order="'.$order.'" loc_per_page="'.$number_loc.'" columns="'.$columns.'" slug="'.$slug.'" logged_in_user_only="'.$logged_in.'" directory_type="'.$types.'" default_directory_type="'.$default_types.'"]' );
    }
}

//Single category
class FindBiz_SingleCat extends Widget_Base
{
    public function get_name()
    {
        return 'single_cat';
    }

    public function get_title()
    {
        return __('Category Archive', 'findbiz-core');
    }

    public function get_icon()
    {
        return '  eicon-theme-builder';
    }

    public function get_keywords()
    {
        return ['single category', 'single listing category', 'category',];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'listings',
            [
                'label' => __('Single Listing Category', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'findbiz-core'),
                    'list' => esc_html__('List View', 'findbiz-core'),
                    'map' => esc_html__('Map View', 'findbiz-core'),
                    'listings_with_map' => esc_html__('Listings With Map View', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
                'condition' => [
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'preview',
            [
                'label' => __('Show Preview Image?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'listings_with_map',
                ]
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'findbiz-core'),
                    '4' => esc_html__('4 Items / Row', 'findbiz-core'),
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label' => __('Map Height', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 300,
                'max' => 1980,
                'default' => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]

        );

        $this->add_control(
            'zoom_level',
            [
                'label'   => __('Map Zoom Level', 'findbiz-core'),
                'type'    => Controls_Manager::SLIDER ,
                'range' => [
					'px' => [
						'min' => 1,
						'max' => 18,
						'step' => 1,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'condition' => [
                    'layout' => 'map'
                ]
            ]
        );

        $this->add_control(
            'header',
            [
                'label' => __('Show Header?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'findbiz-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'findbiz-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'header' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'     => __('Show Filter Button?', 'findbiz-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'header' => 'yes',
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'listings_count',
            [
                'label' => __('Number of Listings to Show:', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => __('Show Featured Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label' => __('Show Popular Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'findbiz-core'),
                    'date' => esc_html__(' Date', 'findbiz-core'),
                    'price' => esc_html__(' Price', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'findbiz-core'),
                    'desc' => esc_html__(' DESC', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $default_types   = $settings['default_types'];
        $types           = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $preview         = $settings['preview'] ? $settings['preview'] : 'no';
        $layout          = $settings['layout'];
        $zoom_level      = $settings['zoom_level'];
        $map_height      = $settings['map_height'];
        $header          = $settings['header'];
        $title           = $settings['title'];
        $filter          = $settings['filter'];
        $user            = $settings['user'];
        $row             = $settings['row'];
        $rows             = $settings['rows'];
        $listings_count  = $settings['listings_count'];
        $featured        = $settings['featured'];
        $popular         = $settings['popular'];
        $order_by        = $settings['order_by'];
        $order_list      = $settings['order_list'];
        $show_pagination = $settings['show_pagination'];
        
        echo ( 'listings_with_map' === $layout ) ? '<input type="hidden" id="listing-listings_with_map">' : '';

        echo do_shortcode(' [directorist_category view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($listings_count) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" advanced_filter="'.$filter.'" columns="' . esc_attr($row) . '" listings_with_map_columns="' . esc_attr($rows) . '" show_pagination="' . esc_attr($show_pagination) . '" map_height="' . $map_height . '" map_zoom_level="'.$zoom_level.'" display_preview_image="'.$preview.'" logged_in_user_only="' . esc_attr($user) . '" directory_type="' . esc_attr($types) . '" default_directory_type="' . esc_attr($default_types) . '"]');
    }
}

//Single location
class FindBiz_SingleLoc extends Widget_Base
{
    public function get_name()
    {
        return 'single_loc';
    }

    public function get_title()
    {
        return __('Location Archive', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-map-pin';
    }

    public function get_keywords()
    {
        return ['single location', 'need location', 'location',];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'listings',
            [
                'label' => __('Single Location', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'findbiz-core'),
                    'list' => esc_html__('List View', 'findbiz-core'),
                    'map' => esc_html__('Map View', 'findbiz-core'),
                    'listings_with_map' => esc_html__('Listings With Map View', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
                'condition' => [
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label' => __('Map Height', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 300,
                'max' => 1980,
                'default' => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]

        );

        $this->add_control(
            'zoom_level',
            [
                'label'   => __('Map Zoom Level', 'findbiz-core'),
                'type'    => Controls_Manager::SLIDER ,
                'range' => [
					'px' => [
						'min' => 1,
						'max' => 18,
						'step' => 1,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'condition' => [
                    'layout' => 'map'
                ]
            ]
        );

        $this->add_control(
            'preview',
            [
                'label' => __('Show Preview Image?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'header',
            [
                'label' => __('Show Header?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'findbiz-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'findbiz-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'header' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'     => __('Show Filter Button?', 'findbiz-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'header' => 'yes',
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'findbiz-core'),
                    '4' => esc_html__('4 Items / Row', 'findbiz-core'),
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'listings_with_map',
                ]
            ]
        );

        $this->add_control(
            'listings_count',
            [
                'label' => __('Number of Listings to Show:', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => __('Show Featured Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label' => __('Show Popular Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'findbiz-core'),
                    'date' => esc_html__(' Date', 'findbiz-core'),
                    'price' => esc_html__(' Price', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'findbiz-core'),
                    'desc' => esc_html__(' DESC', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $default_types   = $settings['default_types'];
        $types           = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $preview         = $settings['preview'] ? $settings['preview'] : 'no';
        $layout          = $settings['layout'];
        $zoom_level      = $settings['zoom_level'];
        $map_height      = $settings['map_height'];
        $header          = $settings['header'];
        $title           = $settings['title'];
        $filter          = $settings['filter'];
        $user            = $settings['user'];
        $row             = $settings['row'];
        $rows            = $settings['rows'];
        $listings_count  = $settings['listings_count'];
        $featured        = $settings['featured'];
        $popular         = $settings['popular'];
        $order_by        = $settings['order_by'];
        $order_list      = $settings['order_list'];
        $show_pagination = $settings['show_pagination'];
        
        echo ( 'listings_with_map' === $layout ) ? '<input type="hidden" id="listing-listings_with_map">' : '';

        echo do_shortcode(' [directorist_location view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($listings_count) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" advanced_filter="'.$filter.'" columns="' . esc_attr($row) . '" listings_with_map_columns="' . esc_attr($rows) . '" show_pagination="' . esc_attr($show_pagination) . '" map_height="' . $map_height . '" map_zoom_level="'.$zoom_level.'" display_preview_image="'.$preview.'" logged_in_user_only="' . esc_attr($user) . '" directory_type="' . esc_attr($types) . '" default_directory_type="' . esc_attr($default_types) . '"]');
    }
}

//Single tag
class FindBiz_SingleTag extends Widget_Base
{
    public function get_name()
    {
        return 'single_tag';
    }

    public function get_title()
    {
        return __('Tag Archive', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-tags';
    }

    public function get_keywords()
    {
        return ['single tag', 'need tag', 'tag',];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'single_tag',
            [
                'label' => __('Single Listing Tag', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => __('View As', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'findbiz-core'),
                    'list' => esc_html__('List View', 'findbiz-core'),
                    'map'  => esc_html__('Map View', 'findbiz-core'),
                    'listings_with_map' => esc_html__('Listings With Map View', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
                'condition' => [
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'row',
            [
                'label'   => __('Listings Per Row', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'findbiz-core'),
                    '4' => esc_html__('4 Items / Row', 'findbiz-core'),
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'listings_with_map',
                ]
            ]
        );

        $this->add_control(
            'header',
            [
                'label'   => __('Show Header?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __('Listings Found Text', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'findbiz-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'condition'   => [
                    'header' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'   => __('Show More Filter?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => [
                    'header' => 'yes',
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'preview',
            [
                'label' => __('Show Preview Image?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'user',
            [
                'label'   => __('Only For Logged In User?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label'   => __('Redirect User?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label'   => __('Redirect Link', 'findbiz-core'),
                'type'    => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label'     => __('Map Height', 'findbiz-core'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 300,
                'max'       => 1980,
                'default'   => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]

        );

        $this->add_control(
            'number_cat',
            [
                'label'   => __('Number of Listings to Show:', 'findbiz-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'cat',
            [
                'label'    => __('Specify Categories', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::categories()
            ]
        );

        $this->add_control(
            'tag',
            [
                'label'    => __('Specify Tags', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::tags()
            ]
        );

        $this->add_control(
            'location',
            [
                'label'    => __('Specify Locations', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::locations()
            ]
        );

        $this->add_control(
            'featured',
            [
                'label'   => __('Show Featured Only?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label'   => __('Show Popular Only?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => __('Order by', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'findbiz-core'),
                    'date'  => esc_html__(' Date', 'findbiz-core'),
                    'price' => esc_html__(' Price', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label'   => __('Listings Order', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__(' ASC', 'findbiz-core'),
                    'desc' => esc_html__(' DESC', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'   => __('Show Pagination?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $default_types   = $settings['default_types'];
        $types           = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $preview         = $settings['preview'] ? $settings['preview'] : 'no';
        $header          = $settings['header'];
        $filter          = $settings['filter'];
        $show_pagination = $settings['show_pagination'];
        $title           = $settings['title'];
        $layout          = $settings['layout'];
        $number_cat      = $settings['number_cat'];
        $row             = $settings['row'];
        $rows            = $settings['rows'];
        $cat             = $settings['cat'] ? implode($settings['cat'], []) : '';
        $tag             = $settings['tag'] ? implode($settings['tag'], []) : '';
        $location        = $settings['location'] ? implode($settings['location'], []) : '';
        $featured        = $settings['featured'];
        $popular         = $settings['popular'];
        $order_by        = $settings['order_by'];
        $order_list      = $settings['order_list'];
        $map_height      = $settings['map_height'];
        $user            = $settings['user'];
        $web             = 'yes' == $user ? $settings['link']['url'] : '';

        echo ( 'listings_with_map' === $layout ) ? '<input type="hidden" id="listing-listings_with_map">' : '';

        echo do_shortcode('[directorist_tag view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" category="' . esc_attr($cat) . '" tag="' . esc_attr($tag) . '" location="' . esc_attr($location) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" columns="' . esc_attr($row) . '" listings_with_map_columns="' . esc_attr($rows) . '" show_pagination="' . esc_attr($show_pagination) . '" advanced_filter="' . esc_attr($filter) . '" map_height="' . $map_height . '" display_preview_image="'.$preview.'" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" directory_type="' . esc_attr($types) . '" default_directory_type="' . esc_attr($default_types) . '"]');
    }
}

//Team
class FindBiz_Team extends Widget_Base
{
    public function get_name()
    {
        return 'team';
    }

    public function get_title()
    {
        return __('Team Members', 'findbiz-core');
    }

    public function get_icon()
    {
        return ' eicon-person';
    }

    public function get_keywords()
    {
        return ['team', 'member'];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'team',
            [
                'label' => __('Team Members Info', 'findbiz-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label'       => esc_html__('Member Name', 'findbiz-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Tom Modie',
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Profile picture', 'findbiz-core'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'label'       => esc_html__('Designation', 'findbiz-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'CTO @ DroitLab',
                'label_block' => true
            ]
        );

        $this->add_control(
            'teams',
            [
                'label'       => __('Team Member', 'findbiz-core'),
                'type'        => Controls_Manager::REPEATER,
                'title_field' => '{{{ name }}}',
                'fields'      => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $teams    = $settings['teams'];
        ?>

        <div class="row team-wrapper">
            <?php foreach ($teams as $team) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="team-single">
                        <figure>
                            <img src="<?php echo esc_url($team['image']['url']) ?>" alt="<?php echo esc_attr(Helper::image_alt($team['image']['id'])); ?>">
                            <figcaption>
                                <h5><?php echo esc_attr($team['name']); ?></h5>
                                <p><?php echo esc_attr($team['designation']); ?></p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

//Testimonial
class FindBiz_Testimonial extends Widget_Base
{
    public function get_name()
    {
        return 'testimonials';
    }

    public function get_title()
    {
        return __('Testimonials', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['testimonial', 'client', 'testi'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'Testimonials',
            [
                'label' => __('Testimonials', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label'       => __('Testimonials', 'findbiz-core'),
                'type'        => Controls_Manager::REPEATER,
                'title_field' => '{{{ name }}}',
                'fields'      => [
                    [
                        'name'        => 'name',
                        'label'       => __('Name', 'findbiz-core'),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => 'Mark Tony'
                    ],
                    [
                        'name'        => 'designation',
                        'label'       => __('Designation', 'findbiz-core'),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => 'Software Developer'
                    ],
                    [
                        'name'  => 'desc',
                        'label' => __('Testimonial Text', 'findbiz-core'),
                        'type'  => Controls_Manager::TEXTAREA,
                    ],
                    [
                        'name'  => 'image',
                        'label' => __('Author Image', 'findbiz-core'),
                        'type'  => Controls_Manager::MEDIA,
                    ],
                ],
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-author h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings     = $this->get_settings_for_display();
        $testimonials = $settings['testimonials'];
        ?>

        <div class="testimonial-carousel owl-carousel">
            <?php foreach ($testimonials as $test) { ?>
                <div class="testimonial-single">
                    <div class="testimonial-author">
                        <img src="<?php echo esc_url($test['image']['url']); ?>" alt="<?php echo Helper::image_alt($test['image']['id']); ?>">
                        <div>
                            <h4><?php echo esc_attr($test['name']); ?></h4>
                            <span><?php echo esc_attr($test['designation']); ?></span>
                        </div>
                    </div>
                    <p class="testimonial-text"><?php echo esc_attr($test['desc']); ?></p>
                    <img src="<?php echo get_theme_file_uri('/img/text-quotes.svg'); ?>" alt="<?php echo esc_html('testimonial quote'); ?>" class="svg">
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

//Booking Confirmation
class Findbiz_Booking extends Widget_Base
{
    public function get_name()
    {
        return 'booking';
    }

    public function get_title()
    {
        return __('Booking Confirmation', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'eicon-check-circle-o';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'booking',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'booking_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'booking_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="findbiz-directorist_booking_confirmation"><?php echo do_shortcode('[directorist_booking_confirmation]'); ?></div>
        <?php
    }
}
