<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 *
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WpWax\FindBiz\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts
class Blogs extends Widget_Base {

	public function get_name() {
		return 'blog_posts';
	}

	public function get_title() {
		return __( 'Blogs', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}
	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'blog', 'post', 'blog post' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'blog_posts',
			array(
				'label' => __( 'Blog Posts', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'post_count',
			array(
				'label'   => __( 'Number of Posts to Show:', 'findbiz-core' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 3,
			)
		);

		$this->add_control(
			'order_by',
			array(
				'label'   => __( 'Order by', 'findbiz-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'ID'            => esc_html__( ' Post ID', 'findbiz-core' ),
					'author'        => esc_html__( ' Author', 'findbiz-core' ),
					'title'         => esc_html__( ' Title', 'findbiz-core' ),
					'name'          => esc_html__( ' Post name (post slug)', 'findbiz-core' ),
					'type'          => esc_html__( ' Post type (available since Version 4.0)', 'findbiz-core' ),
					'date'          => esc_html__( ' Date', 'findbiz-core' ),
					'modified'      => esc_html__( ' Last modified date', 'findbiz-core' ),
					'rand'          => esc_html__( ' Random order', 'findbiz-core' ),
					'comment_count' => esc_html__( ' Number of comments', 'findbiz-core' ),
				),
			)
		);

		$this->add_control(
			'order_list',
			array(
				'label'   => __( 'Order post', 'findbiz-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'ASC'  => esc_html__( ' ASC', 'findbiz-core' ),
					'DESC' => esc_html__( ' DESC', 'findbiz-core' ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$post_count = $settings['post_count'];
		$order_by   = $settings['order_by'];
		$order_list = $settings['order_list'];

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => esc_attr( $post_count ),
			'order'          => esc_attr( $order_list ),
			'orderby '       => esc_attr( $order_by ),
		);

		$posts = new \WP_Query( $args ); ?>
		<div class="blog-posts row" data-uk-grid>
			<?php
			while ( $posts->have_posts() ) {
				$posts->the_post();
				?>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="blog-posts__single">
						<?php the_post_thumbnail( 'findbiz_blog_grid' ); ?>
						<div class="blog-posts__single__contents">
							<?php the_title( sprintf( '<h4><a href="%s">', get_the_permalink() ), '</a></h4>' ); ?>
							<ul>
								<li><?php echo Helper::time(); ?></li>
								<?php Helper::post_categories(); ?>
							</ul>
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}
