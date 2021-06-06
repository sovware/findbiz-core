<?php
if (!defined('ABSPATH')) {
    exit;
}
//===========findbiz Color Control Customizer Panel=============

function findbiz_custom_style()
{

    $primary = get_theme_mod('p_color', '#1ec659');
    $primary_g = get_theme_mod('p_g_color', 'rgba(30,198,89,0.08)');
    $success = get_theme_mod('su_color', '#53ca2e');
    $info = get_theme_mod('in_color', '#2c99ff');
    $danger = get_theme_mod('dn_color', '#f51957');
    $warnning = get_theme_mod('wr_color', '#fa8b0c'); ?>

    <style>
        <?php if('#1ec659' != $primary) { ?>
            /* Primary color */
            #gmap .leaflet-popup-content .media-body .osm-iw-get-location span,
            #gmap .leaflet-popup-content .media-body .osm-iw-location span,
            #gmap .leaflet-popup-content .media-body h3 a:hover,
            #login_modal .form-excerpts .recover-pass-link:hover,
            #login_modal .form-excerpts ul li a:hover,
            #map .leaflet-popup-content .media-body .osm-iw-get-location span,
            #map .leaflet-popup-content .media-body .osm-iw-location span,
            #map .leaflet-popup-content .media-body h3 a:hover,
            #result ul li:before,
            #result ul li:hover a,
            #show-sidebar,
            #signup_modal .form-excerpts ul li a:hover,
            .address_result ul li:before,
            .address_result ul li:hover a,
            .ads-advanced .more-less,
            .ads-advanced .more-or-less,
            .app-rated .download-content__head p strong,
            .app-rated .download-content__head--end,
            .atbd_add_listing_wrapper .atbdp_make_str_green,
            .atbd_add_listing_wrapper .map_drag_info,
            .atbd_author_info_widget .atbd_widget_contact_info ul li span:first-child,
            .atbd_author_info_widget .btn:not(.btn-primary),
            .atbd_categorized_listings .listings > li .cate_title .atbd_listing_average_pricing,
            .atbd_categorized_listings .listings > li .cate_title h4 a:hover,
            .atbd_categorized_listings .listings > li .directory_tag span .atbd_cat_popup .atbd_cat_popup_wrapper span a:hover,
            .atbd_categorized_listings .listings > li .directory_tag span a:hover,
            .atbd_categorized_listings .listings > li .listing_value span,
            .atbd_category_single figure figcaption .icon,
            .atbd_category_single figure:hover figcaption .icon,
            .atbd_category_single.atbd_category-default figure figcaption .icon,
            .atbd_contact_information_module .atbd_contact_info ul .atbd_info_title span,
            .atbd_listing_bottom_content .atbd_content_left .atbd_listting_category a span,
            .atbd_listing_bottom_content .atbd_content_left .atbd_listting_category a:hover,
            .atbd_listing_bottom_content a.findbiz-grid-cont-btn,
            .atbd_listing_data_list ul p span.fa,
            .atbd_listing_data_list ul p span.la,
            .atbd_listing_info .atbd_listing_title a:hover,
            .atbd_listing_meta .atbd_listing_average_right li a:hover,
            .atbd_listing_meta .atbd_listing_average_right li span:first-child,
            .atbd_listting_category .atbd_cat_popup .atbd_cat_popup_wrapper span a:hover,
            .atbd_map_shape > span,
            .atbd_meta.atbd_listing_price,
            .atbd_pricing_special .pricing__features a:hover,
            .atbd_sidebar .widget_archive ul .children:before,
            .atbd_sidebar .widget_archive ul li.menu-item-has-children:before,
            .atbd_sidebar .widget_archive ul li:before,
            .atbd_sidebar .widget_categories ul .children:before,
            .atbd_sidebar .widget_categories ul li.menu-item-has-children:before,
            .atbd_sidebar .widget_categories ul li:before,
            .atbd_sidebar .widget_nav_menu ul .children:before,
            .atbd_sidebar .widget_nav_menu ul li.menu-item-has-children:before,
            .atbd_sidebar .widget_nav_menu ul li:before,
            .atbd_sidebar .widget_pages ul .children:before,
            .atbd_sidebar .widget_pages ul li.menu-item-has-children:before,
            .atbd_sidebar .widget_pages ul li:before,
            .atbd_sidebar .widget_product_categories ul .children:before,
            .atbd_sidebar .widget_product_categories ul li.menu-item-has-children:before,
            .atbd_sidebar .widget_product_categories ul li:before,
            .atbd_widget .default-ad-search button[type=reset]:hover,
            .atbdb_content_module_contents .table-inner .table tbody tr .findbiz_plane_name p span .atpp_change_plan,
            .atbdb_content_module_contents .table-inner .table tbody tr td .active,
            .atbdb_content_module_contents .table-inner .table tbody tr td .atbd_listing_icon ul li span i,
            .atbdb_content_module_contents .table-inner .table tbody tr td .dropdown-menu .dropdown-item:hover,
            .atbdb_content_module_contents .table-inner .table tbody tr td h6 a:hover,
            .atbdp-res-btns .dlm-res-btn.active span,
            .atbdp-universal-pagination ul li.atbd-active:hover,
            .atbdp-universal-pagination ul li.atbd-selected,
            .atbdp-universal-pagination ul li[class^=atbd-page-jump-]:hover,
            .atbdp-widget-categories .atbdp_parent_category li a:hover,
            .atbdp-widget-categories .atbdp_parent_category li > .cat-trigger:hover,
            .atbdp_faq_widget .atbdp-accordion .accordion-single h3 a:hover,
            .atbd_single_listing.atbd_listing_card .atbdp_mark_as_fav.atbdp_fav_isActive .atbd_fav_icon::after,
            .atbdp_parent_category li a:hover span,
            .atbdpr-range .atbdpr_amount,
            .author-agency .service-delivery_deadline i,
            .author-agency .service-delivery_deadline span,
            .author-info-wrapper .author-contact ul li a span,
            .author-info-wrapper .author-contact ul li p span,
            .author__access_area ul li .author-info ul li a:hover,
            .bdmv_wrapper .ajax-search-result .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown .dropdown-menu a:active,
            .bdmv_wrapper .ajax-search-result .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown a.btn:hover,
            .bdmv_wrapper .ajax-search-result .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a.active,
            .bdmv_wrapper .ajax-search-result .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a:hover,
            .bdmv_wrapper .bdmv-map-listing .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown .dropdown-menu a:active,
            .bdmv_wrapper .bdmv-map-listing .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown a.btn:hover,
            .bdmv_wrapper .bdmv-map-listing .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a.active,
            .bdmv_wrapper .bdmv-map-listing .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a:hover,
            .bdmv_wrapper .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown .dropdown-menu a:active,
            .bdmv_wrapper .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown a.btn:hover,
            .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-default:hover,
            .bdmv_wrapper .default-ad-search .submit_btn .btn-default:hover,
            .bdmv_wrapper.bdmv-columns-two .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown .sort-by a:hover,
            .bdmv_wrapper.bdmv-columns-two .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a.active,
            .bdmv_wrapper.bdmv-columns-two .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a:hover,
            .block-single__icon i,
            .blog .sidebar .widget ul li a:hover,
            .blog .sidebar .widget-wrapper .post-title:hover,
            .blog-area .sidebar .widget ul li a:hover,
            .blog-area .sidebar .widget-wrapper .post-title:hover,
            .blog-posts__single__contents h4 a:hover,
            .blog-posts__single__contents ul li a,
            .breadcrumb-top .breadcrumb .breadcrumb-item a:hover,
            .btn-play .btn-icon,
            .card-grid__bottom p i,
            .card-grid__header h6:hover,
            .card-list__header h6:hover,
            .cart_module .cart__items .cart_info a.button,
            .cart_module .cart__items .cart_info p span,
            .cart_module .cart__items .items .item_info > a:hover,
            .cart_module .cart__items .items .item_remove span,
            .category-wrapper .category-single .category-single__inner .category-icon span,
            .color-primary,
            .comment-respond p.logged-in-as a:hover,
            .comment-respond p.logged-in-as a:last-child,
            .current-menu-parent .current-menu-item > a,
            .current-menu-parent > a,
            .delivery_button_link .atbd_report a .atbd_report a span,
            .delivery_button_link .atbd_report a:hover,
            .delivery_button_link .atbd_report a > span,
            .delivery_button_link li.delivery_button_inner.dropdown .dropdown-menu ul li > a:hover,
            .delivery_button_link li.delivery_button_inner.listing_share > div > span .atbd_report a span,
            .delivery_button_link li.delivery_button_inner.listing_share > div > span:hover,
            .delivery_button_link li.delivery_button_inner.listing_share > div > span > span,
            .delivery_button_link li.delivery_button_inner.save_listing > span > a:hover,
            .delivery_button_link li.delivery_button_inner.save_listing > span > span,
            .findbiz-text-block h3 strong,
            .findbiz_product-details .product-info .price .woocommerce-Price-amount,
            .findbiz_product-details .product-info .price ins,
            .footer-light .footer-bottom--social a,
            .footer-top .calendar_wrap table caption,
            .grid-single .post--card .card-body h3 a:hover,
            .list-features_one li .list-count span,
            .list-features_two .list-content .icon span,
            .listing-carousel .owl-nav button:hover,
            .listing-details-wrapper .auther_agency_main .atbd_listing_meta .atbd_listing_average_right .atbd_service_budget > span.la,
            .listing-details-wrapper .auther_agency_main .atbd_listing_meta .atbd_listing_average_right .listing-details-price > span,
            .mainmenu__menu .navbar-nav > li.menu-item .sub-menu .menu-item-has-children > ul li a:hover,
            .mainmenu__menu .navbar-nav > li.menu-item .sub-menu li:hover a,
            .mainmenu__menu .navbar-nav > li:hover > a,
            .map-icon-label i,
            .outline-primary,
            .page .atbd_sidebar .widget-wrapper .post-title:hover,
            .page .atbd_sidebar .woocommerce ul.product_list_widget li .product-title:hover,
            .page-template-default .atbd_generic_header .atbd_listing_action_btn .view-mode a span:hover,
            .page-template-default .atbd_generic_header .atbd_listing_action_btn .view-mode a.active span,
            .page-template-default .atbd_generic_header_title button.more-filter:hover,
            .play--btn a:hover,
            .post--card .card-body .post-meta li a:hover,
            .post--card2 .card-body .post-meta li a:hover,
            .post--card2 .card-body h3 a:hover,
            .post-author .author-info .social-basic li a:hover,
            .post-author .author-info h5 span,
            .post-details .post-content .post-body ol li:before,
            .post-details .post-header ul a:hover,
            .post-pagination .next-post .title:hover,
            .post-pagination .next-post p a,
            .post-pagination .next-post p span a,
            .post-pagination .prev-post .title:hover,
            .post-pagination .prev-post p a,
            .post-pagination .prev-post p span a,
            .pricing .pricing__features .price_action .price_action--btn,
            .related-post .single-post p a:hover,
            .search-categories ul li a:hover .fa,
            .search-categories ul li a:hover .la,
            .search-categories ul li a:hover h5,
            .search-form-wrapper .directory_search_area .directory_home_category_area ul.categories li a:hover p,
            .search-form-wrapper .directory_search_area .directory_home_category_area ul.categories li a:hover span,
            .search-form-wrapper .directory_search_area .search-form-title h1 span,
            .search-form-wrapper.search-form-wrapper--two .directory_search_area .directory_home_category_area ul.categories li a:hover p,
            .search-form-wrapper.search-form-wrapper--two .directory_search_area .directory_home_category_area ul.categories li a:hover span,
            .search-form-wrapper.search-form-wrapper--two .directory_search_area .pyn-search-group .pyn-search-radio input:checked + label,
            .section-title h1 span,
            .section-title h2 span,
            .section-title h3 span,
            .section-title h4 span,
            .section-title h5 span,
            .section-title h6 span,
            .service-cards .card-single .card-single-content .service-icon i,
            .service-cards#style-two .card-single .card-single-content .service-icon i,
            .service-delivery .service-delivery_deadline i,
            .service-delivery .service-delivery_deadline span,
            .sidebar .widget_archive ul .children:before,
            .sidebar .widget_archive ul li.menu-item-has-children:before,
            .sidebar .widget_archive ul li:before,
            .sidebar .widget_categories ul .children:before,
            .sidebar .widget_categories ul li.menu-item-has-children:before,
            .sidebar .widget_categories ul li:before,
            .sidebar .widget_nav_menu ul .children:before,
            .sidebar .widget_nav_menu ul li.menu-item-has-children:before,
            .sidebar .widget_nav_menu ul li:before,
            .sidebar .widget_pages ul .children:before,
            .sidebar .widget_pages ul li.menu-item-has-children:before,
            .sidebar .widget_pages ul li:before,
            .sidebar .widget_product_categories ul .children:before,
            .sidebar .widget_product_categories ul li.menu-item-has-children:before,
            .sidebar .widget_product_categories ul li:before,
            .single-at_biz_dir .delivery_all .search-all .location-wrapper .search-categories ul li a:hover,
            .single-at_biz_dir .delivery_all .search-all .location-wrapper .search-categories ul li a:hover span,
            .single-at_biz_dir .delivery_all .search-all .search-wrapper .search-categories ul li a:hover,
            .single-at_biz_dir .delivery_all .search-all .search-wrapper .search-categories ul li a:hover span,
            .single-at_biz_dir .edit_btn_wrap .atbd_go_back:hover,
            .single-at_biz_dir .widget_nav_menu ul li a:hover,
            .single-at_biz_dir .widget-wrapper .post-title:hover,
            .single-post .sidebar .widget ul li a:hover,
            .single-post .sidebar .widget-wrapper .post-title:hover,
            .single_area .sidebar .woocommerce ul.product_list_widget li a:hover,
            .sponser-carousel .owl-nav button:hover span,
            .store-btns .btn:hover,
            .store-btns .btn:hover span:before,
            .tab-pane .atbdb_content_module_contents ol li:before,
            .tab_main .nav .nav-item a:hover,
            .tab_main .nav .nav-item a:hover span,
            .tab_main .nav-pills .nav-link.active,
            .tab_main .nav-pills .nav-link.active span,
            .video__btn,
            .widget.atbd_widget .directorist button:not(.btn-primary),
            .widget_recent_comments ul li a,
            .widget_rss ul li span,
            .widget_social .social-list li .title,
            .widget_social li a:hover,
            .widget_social li > .cat-trigger:hover,
            .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a,
            .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers:hover,
            .woocommerce div.product .findbiz_product-info-tab .woocommerce-tabs ul.tabs li.active a,
            .woocommerce div.product .price .woocommerce-Price-amount,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
            .woocommerce table.shop_table .product-name a:hover,
            .woocommerce ul.products li.product .price,
            .woocommerce ul.products li.product .woocommerce-loop-category__title:hover,
            .woocommerce ul.products li.product .woocommerce-loop-product__title:hover,
            .woocommerce ul.products li.product h3:hover,
            figure figcaption a,
            footer .footer-bottom--content p span,
            footer .footer-top .post-single P span a,
            footer.footer-section .footer-top .store-btns .btn:hover,
            footer.footer-section .footer-top .store-btns .btn:hover span:before,
            .footer-light .social-list li i,
            .footer-bottom--content a,
            footer .footer-top ul li a:hover,
            .sidebar .widget_calendar tr th,
            .atbd_sidebar .widget_calendar tr th,
            .sidebar .widget_calendar tr td#prev a,
            .sidebar .widget_calendar tr td#next a,
            .atbd_sidebar .widget_calendar tr td#prev a,
            .atbd_sidebar .widget_calendar tr td#next a,
            .service-delivery ul li.service-delivery_deadline span,
            .btn-outline-primary,
            .service-delivery ul li i,
            .findbiz_product-details .product-info .product_meta .posted_in a,
            .shipping-calculator-button,
            .showcoupon,
            .woocommerce-privacy-policy-link,
            .play--btn a,
            .atbd_author_info_widget .btn,
            .widget .dcl_promo-item_group .btn,
            .bg-footer-light p a,
            #directorist.atbd_wrapper .atbd_single_listing.atbd_listing_list .atbdp_mark_as_fav .atbd_fav_icon::after,
            .text-primary,
            .atbdp_mark_as_fav.atbdp_fav_isActive .atbd_fav_icon::after,
            .action span a,
            .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item a,
            .product-title,
            .woocommerce-MyAccount-content a {
                color: <?php echo esc_attr($primary); ?> !important;
            }

            /* prrmary background */
            #directorist.atbd_wrapper .atbd_single_listing.atbd_listing_list .atbdp_mark_as_fav.atbdp_fav_isActive,
            #directorist.atbd_wrapper .btn.btn-primary,
            #directorist.atbd_wrapper.directorist-checkout-form #atbdp-checkout-form #atbdp_pay_notpay_btn .btn-primary,
            #show-sidebar .bar,
            .ads-advanced .price-frequency .pf-btn input:checked + span,
            .at-modal .atm-contents-inner .at-modal-close,
            .at-modal .atm-contents-inner .atbd_modal-footer .atbd_modal_btn,
            .atbd_add_listing_wrapper .select2-container--default .select2-selection--multiple .select2-selection__choice,
            .atbd_add_listing_wrapper input[type=checkbox]:checked:after,
            .atbd_auhor_profile_area .atbd_author_meta .atbd_listing_meta .atbd_listing_rating,
            .atbd_author_info_widget .atbd_avatar_wrapper .atbd_name_time h4 .verified,
            .atbd_author_info_widget .btn:hover,
            .atbd_authors_listing .author-listing-header .atbd-auth-listing-types a:before,
            .atbd_category_single figure figcaption:before,
            .atbd_contact_information_module .atbd_director_social_wrap a:hover,
            .atbd_content_active .widget.atbd_widget + #dcl-claim-modal .modal-footer .btn,
            .atbd_google_map .gm-style .gm-style-iw .gm-style-iw-d .miw-contents .miwl-rating .atbd_meta,
            .atbd_listing_bottom_content a.findbiz-grid-cont-btn:hover,
            .atbd_listing_meta .atbd_listing_rating,
            .atbd_listing_thumbnail_area .atbd_lower_badge .atbd_badge_new,
            .atbd_listing_thumbnail_area .atbd_upper_badge .atbd_badge.atbd_badge_new,
            .atbd_listing_type_list a.choose-type-btn.ctb--one,
            .atbd_location_grid figure figcaption:before,
            .atbd_manage_fees_wrapper table .btn:hover,
            .atbd_map_shape,
            .atbd_pricing_options input[type=checkbox]:checked:after,
            .atbd_pricing_special .pricing__features a,
            .atbd_sidebar .widget-wrapper .widget-default .search-form button,
            .atbd_sidebar .widget-wrapper .widget-default .search-form button:hover,
            .atbd_sidebar .widget-wrapper .widget-default .search-form input.search-submit,
            .atbd_sidebar .widget-wrapper .widget-default .search-form input.search-submit:hover,
            .atbd_sidebar .widget-wrapper .woocommerce-product-search button,
            .atbd_sidebar .widget-wrapper .woocommerce-product-search button:hover,
            .atbd_sidebar .widget-wrapper .woocommerce-product-search input.search-submit,
            .atbd_sidebar .widget-wrapper .woocommerce-product-search input.search-submit:hover,
            .atbd_sidebar .widget_calendar tr td#today,
            .atbd_sidebar .widget_product_search .widget-default .search-form button,
            .atbd_sidebar .widget_product_search .widget-default .search-form button:hover,
            .atbd_sidebar .widget_product_search .widget-default .search-form input.search-submit,
            .atbd_sidebar .widget_product_search .widget-default .search-form input.search-submit:hover,
            .atbd_sidebar .widget_product_search .woocommerce-product-search button,
            .atbd_sidebar .widget_product_search .woocommerce-product-search button:hover,
            .atbd_sidebar .widget_product_search .woocommerce-product-search input.search-submit,
            .atbd_sidebar .widget_product_search .woocommerce-product-search input.search-submit:hover,
            .atbdb_content_module_contents .atbd_big_gallery .slick-arrow:hover,
            .atbdp-map .gm-style .gm-style-iw .gm-style-iw-d .miw-contents .miwl-rating .atbd_meta,
            .atbdp-widget-categories .atbdp_parent_category li a:hover span,
            .atbdp-widget-tags ul li a:hover,
            .atbdpr-range .ui-slider-horizontal .ui-slider-range,
            .auther_agency_main .listing-info--badges li .atbd_badge_new,
            .author-agency .findbiz_single_listing_title .dcl_claimed--badge span,
            .author-agency .service-delivery_title .dcl_claimed--badge span,
            .author-profile .author-details .social-share ul li a:hover,
            .badge-verified:before,
            .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-bordered:hover,
            .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-primary,
            .bdmv_wrapper .default-ad-search .submit_btn .btn-bordered:hover,
            .bdmv_wrapper .default-ad-search .submit_btn .btn-primary,
            .bg-dark,
            .bg-primary,
            .bg-success,
            .blog-area .post-details .post-content .post-body input,
            .blog-single.sticky .card .card-body h3:before,
            .btn-checkbox label input:checked + span,
            .btn-gradient,
            .btn-gradient:hover,
            .cart_module .cart__items .cart_info a.button:hover,
            .cart_module .cart__items .cart_info a.checkout,
            .cart_module .cart__items .cart_info a.checkout:hover,
            .cart_module .cart__items .items .item_remove:hover span,
            .cart_module .cart_count,
            .category-wrapper .category-carousel .owl-dots .owl-dot.active span,
            .category-wrapper .category-single .category-single__inner:hover .category-icon,
            .comments-area .comment-lists ul .depth-1 .children .depth-2 .media .media-body .media_top .comment-edit-link:hover,
            .comments-area .comment-lists ul .depth-1 .children .depth-2 .media .media-body .media_top .reply:hover,
            .comments-area .comment-lists ul .depth-1 .media:first-child .media-body .media_top .comment-edit-link:hover,
            .comments-area .comment-lists ul .depth-1 .media:first-child .media-body .media_top .reply:hover,
            .comments-area blockquote,
            .custom-control .custom-control-input:checked ~ .check--select,
            .customers-testimonials .owl-dots .owl-dot span,
            .customers-testimonials .owl-dots .owl-dot.active span,
            .delivery_image_left.social-share ul li a:hover,
            .directory_search_area .atbd_submit_btn button.btn_search,
            .directory_search_area .atbd_submit_btn button.btn_search:hover,
            .directory_search_area .select2-container--default .select2-results__option--highlighted[aria-selected],
            .error-contents .input-group button,
            .ezmu__btn,
            .findbiz-btn,
            .findbiz-btn:hover,
            .findbiz_product-details .gallery-image-view .onsale,
            .findbiz_product-details .product-info .cart .single_add_to_cart_button,
            .findbiz_product-details .product-info form.variations_form .variations .reset_variations,
            .footer-light .social.social--small ul li a span:hover:before,
            .footer-top #today,
            .footer-top form button,
            .grid-item:hover:before,
            .image-preview-input,
            .keep_signed input[type=checkbox]:checked + label:before,
            .keep_signed label input[type=checkbox]:checked + span:before,
            .leaflet-pane .marker-cluster-medium > div,
            .leaflet-pane .marker-cluster-small > div,
            .listing-carousel .owl-dots .owl-dot span,
            .listing-carousel .owl-dots .owl-dot.active span,
            .listing-info .listing-info--meta .atbd_listing_rating,
            .marker-cluster-shape,
            .more-filter:hover,
            .offcanvas-menu__contents ul li a:hover,
            .page .atbd_sidebar .social.social--small ul li a,
            .page .atbd_sidebar .sort-rating .custom-control-label span,
            .page .atbd_sidebar .widget form button,
            .pagination .nav-links .page-numbers.current,
            .pagination .nav-links .page-numbers:hover,
            .play--btn span,
            .pricing .pricing__features .price_action .price_action--btn:hover,
            .pricing .pricing__title h4 .atbd_plan-active,
            .profile-img .choose_btn #upload_pro_pic,
            .select2-container--default .select2-results__option--highlighted[aria-selected],
            .service-delivery .findbiz_single_listing_title .dcl_claimed--badge span,
            .service-delivery .service-delivery_title .dcl_claimed--badge span,
            .sidebar .widget-wrapper .widget-default .search-form button,
            .sidebar .widget-wrapper .widget-default .search-form button:hover,
            .sidebar .widget-wrapper .widget-default .search-form input.search-submit,
            .sidebar .widget-wrapper .widget-default .search-form input.search-submit:hover,
            .sidebar .widget-wrapper .woocommerce-product-search button,
            .sidebar .widget-wrapper .woocommerce-product-search button:hover,
            .sidebar .widget-wrapper .woocommerce-product-search input.search-submit,
            .sidebar .widget-wrapper .woocommerce-product-search input.search-submit:hover,
            .sidebar .widget_calendar tr td#today,
            .sidebar .widget_product_search .widget-default .search-form button,
            .sidebar .widget_product_search .widget-default .search-form button:hover,
            .sidebar .widget_product_search .widget-default .search-form input.search-submit,
            .sidebar .widget_product_search .widget-default .search-form input.search-submit:hover,
            .sidebar .widget_product_search .woocommerce-product-search button,
            .sidebar .widget_product_search .woocommerce-product-search button:hover,
            .sidebar .widget_product_search .woocommerce-product-search input.search-submit,
            .sidebar .widget_product_search .woocommerce-product-search input.search-submit:hover,
            .single_area .sidebar .social.social--small ul li a:hover,
            .social-share ul li a:hover,
            .social.social--small ul li a:hover,
            .sort-rating .custom-control-label span,
            .sticky .grid-single .post--card .card-body h3:before,
            .tags ul li a:hover,
            .testimonial-carousel .owl-dots .owl-dot.active span,
            .testimonial-carousel:after,
            .testimonial-carousel:before,
            .widget .tagcloud .tag-cloud-link:hover,
            .widget.atbd_widget .directorist button:not(.btn-primary):hover,
            .widget_product_tag_cloud .tagcloud ul li a:hover,
            .widget_social li a:hover span,
            .woocommerce #review_form #respond .form-submit input,
            .woocommerce .cart_totals .wc-proceed-to-checkout a.checkout-button,
            .woocommerce .return-to-shop a.wc-backward,
            .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
            .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
            .woocommerce .woocommerce-MyAccount-content .woocommerce-EditAccountForm .woocommerce-Button,
            .woocommerce .woocommerce-MyAccount-content .woocommerce-address-fields button[name=save_address],
            .woocommerce .woocommerce-form-login .woocommerce-form-login__submit,
            .woocommerce .woocommerce-form-login .woocommerce-form-login__submit:hover,
            .woocommerce .woocommerce-pagination .button,
            .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers.current,
            .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers.current:hover,
            .woocommerce .woocommerce-shipping-calculator .shipping-calculator-form p button[name=calc_shipping],
            .woocommerce div.product .findbiz_product-info-tab .woocommerce-tabs .woocommerce-Tabs-panel .woocommerce-Reviews #review_form_wrapper .comment_form_wrapper .form-submit input.btn,
            .woocommerce div.product form.cart .button,
            .woocommerce div.product form.cart .button:hover,
            .woocommerce form.checkout .woocommerce-checkout-payment#payment .place-order button.button,
            .woocommerce form.checkout_coupon .form-row .button,
            .woocommerce form.lost_reset_password button.woocommerce-Button,
            .woocommerce table.shop_table td .button.view,
            .woocommerce table.shop_table td.actions .coupon button.button,
            .woocommerce table.shop_table td.actions button[name=update_cart],
            .woocommerce ul.products li.product .onsale,
            .woocommerce ul.products li.product a.added_to_cart,
            .woocommerce ul.products li.product a.added_to_cart:hover,
            .woocommerce ul.products li.product a.button:hover,
            .wp-block-button__link,
            blockquote,
            blockquote.wp-block-quote,
            footer .footer-bottom .footer-left__parent--son__link .footer-left__parent--son__link__span:hover,
            footer .footer-bottom .footer-left__parent--son__link:hover,
            footer .footer-bottom--social a:hover,
            footer .social.social--small ul li a span:hover:before,
            footer .subscribe-widget form .btn,
            footer input.search-submit,
            .btn-outline-primary:hover,
            .widget .dcl_promo-item_group .btn:hover,
            .author-profile .author-details .social-share ul li a:hover,
            .woocommerce .widget_price_filter .price_slider_amount .button,
            .modal-footer .btn-primary,
            .form-vertical button,
            .access_area li a.btn-primary,
            .cta-wrapper .btn-primary,
            .subscribe-widget form .btn-primary,
            .comment-respond .form-submit .btn-primary,
            .quick_search_btn_wrapper .btn_search{
                background: <?php echo esc_attr($primary); ?> !important;
            }

            /* primary border */
            #login_modal .modal-body .form-excerpts input,
            #moda_claim_listing .modal-body .form-excerpts input,
            #signup_modal .modal-body .form-excerpts input,
            .atbd_add_listing_wrapper .select2-container--default .select2-selection--multiple .select2-selection__choice,
            .atbd_add_listing_wrapper input[type=checkbox]:checked:after,
            .atbd_listing_bottom_content a.findbiz-grid-cont-btn:hover,
            .atbd_pricing_options input[type=checkbox]:checked:after,
            .atbd_sidebar .widget-wrapper .widget-default .search-form button,
            .atbd_sidebar .widget-wrapper .widget-default .search-form input.search-submit,
            .atbd_sidebar .widget-wrapper .woocommerce-product-search button,
            .atbd_sidebar .widget-wrapper .woocommerce-product-search input.search-submit,
            .atbd_sidebar .widget_product_search .widget-default .search-form button,
            .atbd_sidebar .widget_product_search .widget-default .search-form input.search-submit,
            .atbd_sidebar .widget_product_search .woocommerce-product-search button,
            .atbd_sidebar .widget_product_search .woocommerce-product-search input.search-submit,
            .atbdp-widget-tags ul li a:hover,
            .border-primary,
            .cart_module .cart__items .cart_info a.button,
            .change-pass .form-group input:focus,
            .error-contents .input-group .fc--rounded,
            .error-contents .input-group button,
            .footer-top form input:focus,
            .more-filter:hover,
            .navbar .search-all .location-wrapper .location_module .location_area form .input-group .form-control:focus,
            .navbar .search-all .location-wrapper .location_module .search_area form .input-group .form-control:focus,
            .navbar .search-all .location-wrapper .location_module.active .search_area form .input-group .form-control,
            .navbar .search-all .location-wrapper .search_module .location_area form .input-group .form-control:focus,
            .navbar .search-all .location-wrapper .search_module .search_area form .input-group .form-control:focus,
            .navbar .search-all .location-wrapper .search_module.active .search_area form .input-group .form-control,
            .navbar .search-all .search-wrapper .location_module .location_area form .input-group .form-control:focus,
            .navbar .search-all .search-wrapper .location_module .search_area form .input-group .form-control:focus,
            .navbar .search-all .search-wrapper .location_module.active .search_area form .input-group .form-control,
            .navbar .search-all .search-wrapper .search_module .location_area form .input-group .form-control:focus,
            .navbar .search-all .search-wrapper .search_module .search_area form .input-group .form-control:focus,
            .navbar .search-all .search-wrapper .search_module.active .search_area form .input-group .form-control,
            .navbar .search-all a button,
            .outline-primary,
            .page-template-default .atbd_generic_header .atbd_listing_action_btn .view-mode a span:hover,
            .page-template-default .atbd_generic_header .atbd_listing_action_btn .view-mode a.active span,
            .pagination .nav-links .page-numbers.current,
            .pagination .nav-links .page-numbers:hover,
            .post-details .post-body ul li ol li ul li:before,
            .post-details .post-body ul li:before,
            .pricing .pricing__features .price_action .price_action--btn,
            .sidebar .widget-wrapper .widget-default .search-form button,
            .sidebar .widget-wrapper .widget-default .search-form input.search-submit,
            .sidebar .widget-wrapper .woocommerce-product-search button,
            .sidebar .widget-wrapper .woocommerce-product-search input.search-submit,
            .sidebar .widget_product_search .widget-default .search-form button,
            .sidebar .widget_product_search .widget-default .search-form input.search-submit,
            .sidebar .widget_product_search .woocommerce-product-search button,
            .sidebar .widget_product_search .woocommerce-product-search input.search-submit,
            .single-at_biz_dir .delivery_all .search-all .location-wrapper .location_module .location_area form .input-group .form-control:focus,
            .single-at_biz_dir .delivery_all .search-all .location-wrapper .location_module .search_area form .input-group .form-control:focus,
            .single-at_biz_dir .delivery_all .search-all .location-wrapper .location_module.active .search_area form .input-group .form-control,
            .single-at_biz_dir .delivery_all .search-all .location-wrapper .search_module .location_area form .input-group .form-control:focus,
            .single-at_biz_dir .delivery_all .search-all .location-wrapper .search_module .search_area form .input-group .form-control:focus,
            .single-at_biz_dir .delivery_all .search-all .location-wrapper .search_module.active .search_area form .input-group .form-control,
            .single-at_biz_dir .delivery_all .search-all .search-wrapper .location_module .location_area form .input-group .form-control:focus,
            .single-at_biz_dir .delivery_all .search-all .search-wrapper .location_module .search_area form .input-group .form-control:focus,
            .single-at_biz_dir .delivery_all .search-all .search-wrapper .location_module.active .search_area form .input-group .form-control,
            .single-at_biz_dir .delivery_all .search-all .search-wrapper .search_module .location_area form .input-group .form-control:focus,
            .single-at_biz_dir .delivery_all .search-all .search-wrapper .search_module .search_area form .input-group .form-control:focus,
            .single-at_biz_dir .delivery_all .search-all .search-wrapper .search_module.active .search_area form .input-group .form-control,
            .single-at_biz_dir .delivery_all .search-all a button,
            .sponser-carousel .owl-nav button:hover,
            .tags ul li a:hover,
            .widget .tagcloud .tag-cloud-link:hover,
            .widget.atbd_widget .directorist button:not(.btn-primary),
            .widget_product_tag_cloud .tagcloud ul li a:hover,
            .woocommerce ul.products li.product a.added_to_cart,
            .woocommerce ul.products li.product a.added_to_cart:hover,
            .woocommerce ul.products li.product a.button:hover,
            footer .subscribe-widget form .form-control:focus,
            footer input.search-submit,
            .atbd_listing_bottom_content a.findbiz-grid-cont-btn {
                border: 1px solid <?php echo esc_attr($primary); ?> !important;
            }

            #directorist.atbd_wrapper .btn.btn-primary,
            #directorist.atbd_wrapper.directorist-checkout-form #atbdp-checkout-form #atbdp_pay_notpay_btn .btn-primary,
            .ads-advanced .price-frequency .pf-btn input:checked + span,
            .at-modal .atm-contents-inner .atbd_modal-footer .atbd_modal_btn,
            .atbd_add_listing_wrapper .atbd_business_hour_module .select2-selection:focus,
            .atbd_add_listing_wrapper .atbd_business_hour_module input.form-control:focus,
            .atbd_add_listing_wrapper .atbd_business_hour_module select.form-control:focus,
            .atbd_add_listing_wrapper .atbd_contact_information .select2-selection:focus,
            .atbd_add_listing_wrapper .atbd_contact_information input.form-control:focus,
            .atbd_add_listing_wrapper .atbd_contact_information select.form-control:focus,
            .atbd_add_listing_wrapper .atbd_general_information_module .select2-selection:focus,
            .atbd_add_listing_wrapper .atbd_general_information_module input.form-control:focus,
            .atbd_add_listing_wrapper .atbd_general_information_module select.form-control:focus,
            .atbd_add_listing_wrapper .atbdb_content_module_contents .select2-selection:focus,
            .atbd_add_listing_wrapper .atbdb_content_module_contents input.form-control:focus,
            .atbd_add_listing_wrapper .atbdb_content_module_contents select.form-control:focus,
            .atbd_add_listing_wrapper .selection,
            .atbd_add_listing_wrapper textarea.directory_field:focus,
            .atbd_content_active .widget.atbd_widget + #dcl-claim-modal .modal-footer .btn:hover,
            .atbd_sidebar .widget-wrapper .widget-default .search-form button:hover,
            .atbd_sidebar .widget-wrapper .widget-default .search-form input.search-submit:hover,
            .atbd_sidebar .widget-wrapper .woocommerce-product-search button:hover,
            .atbd_sidebar .widget-wrapper .woocommerce-product-search input.search-submit:hover,
            .atbd_sidebar .widget_product_search .widget-default .search-form button:hover,
            .atbd_sidebar .widget_product_search .widget-default .search-form input.search-submit:hover,
            .atbd_sidebar .widget_product_search .woocommerce-product-search button:hover,
            .atbd_sidebar .widget_product_search .woocommerce-product-search input.search-submit:hover,
            .atbdp-res-btns .dlm-res-btn.active,
            .atbdp-universal-pagination ul li.atbd-active:hover,
            .atbdp-universal-pagination ul li.atbd-selected,
            .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-bordered:hover,
            .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-default:hover,
            .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-primary,
            .bdmv_wrapper .default-ad-search .submit_btn .btn-bordered:hover,
            .bdmv_wrapper .default-ad-search .submit_btn .btn-default:hover,
            .bdmv_wrapper .default-ad-search .submit_btn .btn-primary,
            .blog-area .post-details .post-content .post-body input,
            .btn-checkbox label input:checked + span,
            .custom-control .custom-control-input:checked ~ .check--select,
            .custom-control .custom-control-input:checked ~ .radio--select,
            .delivery_image_left.social-share ul li a:hover,
            .is-style-outline .wp-block-button__link,
            .keep_signed input[type=checkbox]:checked + label:before,
            .keep_signed label input[type=checkbox]:checked + span:before,
            .search-form-wrapper.search-form-wrapper--one .directory_search_area .atbd_seach_fields_wrapper .more-filter:hover,
            .sidebar .widget-wrapper .widget-default .search-form button:hover,
            .sidebar .widget-wrapper .widget-default .search-form input.search-submit:hover,
            .sidebar .widget-wrapper .woocommerce-product-search button:hover,
            .sidebar .widget-wrapper .woocommerce-product-search input.search-submit:hover,
            .sidebar .widget_product_search .widget-default .search-form button:hover,
            .sidebar .widget_product_search .widget-default .search-form input.search-submit:hover,
            .sidebar .widget_product_search .woocommerce-product-search button:hover,
            .sidebar .widget_product_search .woocommerce-product-search input.search-submit:hover,
            .woocommerce .woocommerce-MyAccount-navigation ul li.is-active,
            .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers.current,
            .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers:hover,
            footer input.search-submit:hover,
            .btn-primary,
            .btn-outline-primary,
            .btn-outline-primary:hover {
                border-color: <?php echo esc_attr($primary); ?> !important;
            }

            .atbd_listing_type_list input[type='radio']:checked:after,
            .at-modal .atm-contents-inner .dcl_pricing_plan input:checked + label:before,
            .at-modal .atm-contents-inner .dcl_pricing_plan input:checked + label:before {
                border: 5px solid <?php echo esc_attr($primary); ?> !important;
            }

            .atbdpr-range .ui-slider-horizontal .ui-slider-handle {
                border: 2px solid <?php echo esc_attr($primary); ?> !important;
            }

            .cart_module .cart__items {
                border-top: 1px solid <?php echo esc_attr($primary); ?> !important;
            }

            .bdmv-map-listing.loading::after,
            .ajax-search-result.loading::after {
                border-top-color: <?php echo esc_attr($primary); ?> !important;
            }

            .search-form-wrapper.search-form-wrapper--two .directory_search_area .pyn-search-group .pyn-search-radio input:checked + label,
            .tab_main .nav-pills .nav-link.active,
            .woocommerce div.product .findbiz_product-info-tab .woocommerce-tabs ul.tabs li.active,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active a {
                border-bottom: 1px solid <?php echo esc_attr($primary); ?> !important;
            }

            .atbd_map_shape:before {
                border-top: 13px solid <?php echo esc_attr($primary); ?> !important;
            }

            <?php
        }

        if( 'rgba(30,198,89,0.08)' !== $primary_g){ ?>

            .category-wrapper .category-single .category-single__inner .category-icon,
            .atbd_listing_bottom_content .atbd_content_left .atbd_listting_category a span,
            .testimonial-carousel .owl-dots .owl-dot span,
            .footer-light .footer-bottom--social a,
            .atbdpr-range .ui-slider-horizontal,
            .leaflet-pane .marker-cluster-small,
            .leaflet-pane .marker-cluster-medium,
            .atbdb_content_module_contents .table-inner .table tbody tr td .active,
            .category-wrapper .category-carousel .owl-dots .owl-dot span{
                background: <?php echo esc_attr($primary_g); ?> !important;
            }

            .category-wrapper .category-single .category-single__inner .cat-icon-cloned,
            .service-cards .card-single .card-single-content .service-count {
                color: <?php echo esc_attr($primary_g); ?> !important;
            }

            .testimonial-carousel .testimonial-single .svg path {
                fill: <?php echo esc_attr($primary_g); ?> !important;
            }

            .shadow-primary {
                box-shadow: 0 5px 10px <?php echo esc_attr($primary_g); ?> !important;
            }

            @keyframes pulseVp {
                0% {
                    box-shadow: 0 0 0 0<?php echo esc_attr($primary_g); ?>
                }
                70% {
                    box-shadow: 0 0 0 20px rgba(165, 169, 177, 0)
                }
                to {
                    box-shadow: 0 0 0 0 rgba(239, 243, 242, 0)
                }
            }

            <?php
        }


        if('#53ca2e' != $success){ ?>

            /* success color */
            .bg-success,
            .woocommerce ul.products li.product .onsale,
            .findbiz_product-details .gallery-image-view .onsale,
            .delivery_title span.icon i,
            .atbd_listing_meta .atbd_listing_rating {
                background: <?php echo esc_attr($success); ?> !important;
            }

            .color-success,
            .woocommerce .woocommerce-message:before,
            .woocommerce ul.products li.product a.button.added,
            .woocommerce .woocommerce-order .woocommerce-thankyou-order-received,
            .outline-success,
            .sidebar .widget_calendar tr td#prev a,
            .sidebar .widget_calendar tr td#next a,
            .atbd_sidebar .widget_calendar tr td#prev a,
            .atbd_sidebar .widget_calendar tr td#next a,
            .sidebar .widget_calendar tr th,
            .atbd_sidebar .widget_calendar tr th,
            .widget .directory_open_hours .atbd_today .day,
            .widget .directory_open_hours .atbd_today .atbd_open_close_time,
            .widget .directory_open_hours .atbd_today .atbd_open_close_time .time,
            .service-delivery ul li i,
            .service-delivery ul li.service-delivery_deadline span,
            .sidebar-wrapper .sidebar-header .user-info .user-status i,
            .chiller-theme .sidebar-wrapper .sidebar-menu ul li a#v-pills-packages-tab.active,
            .chiller-theme .sidebar-wrapper .sidebar-menu ul li a#v-pills-history-tab.active,
            .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li .active:before,
            .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li .active,
            .chiller-theme .sidebar-wrapper .sidebar-menu ul li a .active,
            .chiller-theme .sidebar-wrapper .sidebar-menu ul li.active a i,
            .chiller-theme .sidebar-wrapper .sidebar-menu ul li.active a span,
            .page-wrapper.chiller-theme.toggled #close-sidebar,
            .chiller-theme .sidebar-wrapper ul li:hover a i,
            .chiller-theme .sidebar-wrapper ul li:hover a span,
            .chiller-theme .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover,
            .chiller-theme .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover:before,
            .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu:focus + span,
            .atbdb_content_module_contents .table-inner .table tbody tr td .active,
            .findbiz_plane_name .form-vertical .modal-header p a,
            .findbiz_plane_name .form-vertical .modal-footer span i,
            .tab-content .atbd_listting_category > span,
            .atbd_listting_category .atbd_cat_popup .atbd_cat_popup_wrapper span i,
            .pricing .pricing__features ul li span.fa-check,
            .pricing .pricing__features ul li .atbd_color-success,
            .pricing .pricing__features ul li > span.available:first-child,
            .atbd_badge_open,
            #login_modal .status span.color-success,
            #login_modal .status .woocommerce span.woocommerce-message:before,
            .woocommerce #login_modal .status span.woocommerce-message:before,
            #login_modal .status .woocommerce .woocommerce-order span.woocommerce-thankyou-order-received,
            .woocommerce .woocommerce-order #login_modal .status span.woocommerce-thankyou-order-received {
                color: <?php echo esc_attr($success); ?> !important;
            }

            .outline-success,
            .border-success {
                border: 1px solid <?php echo esc_attr($success); ?> !important;
            }

            <?php
        }

        if('#2c99ff' != $info){?>

            /*//info color*/
            .color-info,
            .woocommerce .woocommerce-info:before,
            .outline-info {
                color: <?php echo esc_attr($info); ?> !important;
            }

            .bg-info,
            .woocommerce .woocommerce-info .button,
            .woocommerce .woocommerce-order .woocommerce-thankyou-order-details + p:before {
                background: <?php echo esc_attr($info); ?> !important;
            }

            .border-info,
            .outline-info {
                border: 1px solid <?php echo esc_attr($info); ?> !important;
            }

            .woocommerce .woocommerce-info {
                border-top-color: <?php echo esc_attr($info); ?> !important;
            }

            <?php
        }


        if('#fa8b0c' != $warnning){ ?>

            /*warning color*/
            .color-warning,
            .outline-warning,
            .woocommerce ul.products li.product .star-rating span,
            .findbiz_product-details .product-info .woocommerce-product-rating .star-rating,
            .findbiz_product-details .product-info .woocommerce-product-rating .star-rating > span:before,
            .woocommerce div.product .findbiz_product-info-tab .woocommerce-tabs .woocommerce-Tabs-panel .woocommerce-Reviews .commentlist li .comment-text .star-rating,
            .woocommerce div.product .findbiz_product-info-tab .woocommerce-tabs .woocommerce-Tabs-panel .woocommerce-Reviews .commentlist li .comment-text .star-rating > span:before,
            .woocommerce div.product .findbiz_product-info-tab .woocommerce-tabs .woocommerce-Tabs-panel .woocommerce-Reviews #review_form_wrapper .comment_form_wrapper .comment-form-rating .stars span a,
            .woocommerce .star-rating span::before,
            blockquote.wp-block-quote code,
            blockquote code,
            .comments-area blockquote code,
            .atbdb_content_module_contents .table-inner .table tbody tr td .pending,
            .br-theme-fontawesome-stars .br-widget a.br-active:after,
            .br-theme-fontawesome-stars .br-widget a.br-selected:after {
                color: <?php echo esc_attr($warnning); ?> !important;
            }

            .bg-warning,
            .findbiz-dashboard-no-listing,
            .atbd_upper_badge .atbd_badge.atbd_badge_featured,
            .auther_agency_main .listing-info--badges li .atbd_badge_featured,
            .atbd_listing_thumbnail_area .atbd_lower_badge .atbd_badge_featured {
                background: <?php echo esc_attr($warnning); ?> !important;
            }

            .border-warning,
            .outline-warning {
                border: 1px solid <?php echo esc_attr($warnning); ?> !important;
            }

            <?php
        }


        if('#f51957' != $danger){ ?>

            /* danger color*/
            .color-danger,
            .woocommerce .woocommerce-error:before,
            .outline-danger,
            .atbdp_required,
            #delete-custom-img:hover,
            .widget .atbd_widget_title h4 .atbd_badge_close,
            .atbdp_make_str_red,
            .page-wrapper.chiller-theme.toggled #close-sidebar:hover,
            .atbdb_content_module_contents .table-inner .table tbody tr td .expired,
            .pricing .pricing__features ul li span.fa-times,
            .atbd_listing_meta .atbd_badge_close,
            .color-danger,
            .woocommerce .woocommerce-error:before,
            .directory_open_hours ul li.atbd_closed span,
            .pricing .pricing__features ul li > span.unavailable:first-child,
            #login_modal .status span.color-danger,
            #login_modal .status .woocommerce span.woocommerce-error:before,
            .woocommerce #login_modal .status span.woocommerce-error:before {
                color: <?php echo esc_attr($danger); ?> !important;
            }

            .bg-danger,
            #v-bookmark-tab .table td .atbdp_add_to_fav_listings .atbdp_mark_as_fav:hover,
            #directorist.atbd_wrapper.directorist-checkout-form #atbdp-checkout-form #atbdp_pay_notpay_btn .btn-danger,
            .plupload-thumbs .thumb .atbdp-thumb-actions .thumbremovelink,
            .findbiz_plane_name .form-vertical .modal-body .form-group [type="radio"]:checked + label:after,
            .findbiz_plane_name .form-vertical .modal-body .form-group [type="radio"]:not(:checked) + label:after,
            .atbd_content_active #directorist.atbd_wrapper .atbd_content_module .atbd_badge.atbd_badge_close,
            .pricing.atbd_pricing_special .atbd_popular_badge,
            .atbd_listing_thumbnail_area .atbd_lower_badge .atbd_badge_popular,
            .atbd_listing_thumbnail_area .atbd_upper_badge .atbd_badge.atbd_badge_popular,
            .profile-img #remove_pro_pic,
            .auther_agency_main .listing-info--badges li .atbd_badge_popular {
                background: <?php echo esc_attr($danger); ?> !important;
            }

            .border-danger,
            .outline-danger {
                border: 1px solid <?php echo esc_attr($danger); ?> !important;
            }

            .woocommerce .woocommerce-error {
                border-top-color: <?php echo esc_attr($danger); ?> !important;
            }

            <?php
        } ?>

    </style>

    <?php
}

add_action('wp_head', 'findbiz_custom_style');
