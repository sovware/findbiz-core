<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 * 
 * @author  WpWax
 * @since   1.0
 * @version 1.0
*/ 

use WpWax\FindBiz\Helper;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

//Team
class Team extends Widget_Base
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
        return 'findbiz-el-custom';
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