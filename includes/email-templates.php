<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Professional Email Template System
 */
class WNS_Email_Templates {
    
    public static function get_email_wrapper($content, $title = '') {
        $site_name = get_bloginfo('name');
        $site_url = home_url();
        
        // Use the specific logo URL provided
        $logo_url = 'https://aistudynow.com/wp-content/uploads/2022/11/LOGO-1.png';
        
        return '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>' . esc_html($title ?: $site_name) . '</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f5f7fa; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.6; color: #000000;">
    <div style="background-color: #f5f7fa; padding: 30px 15px;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 3px solid #000000;">
            
            <!-- Clean Header with Logo -->
            <div style="background-color: #ffffff; text-align: center; border-bottom: 2px solid #f8f9fa;">
                <img src="' . esc_url($logo_url) . '" alt="Logo" style="max-width: 180px; height: auto; margin-bottom: 0; display: block; margin-left: auto; margin-right: auto;">
            </div>
            
            <!-- Body Content -->
            <div style="padding: 40px;">
                ' . $content . '
            </div>
            
            <!-- Footer -->
            <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 30px 40px; text-align: center; border-top: 1px solid #e1e8ed;">
                ' . self::get_social_links() . '
                <div style="font-size: 14px; color: #6c757d; margin: 20px 0; line-height: 1.6;">
                    <p style="margin: 0 0 10px 0; font-weight: 500;">You\'re receiving this email because you subscribed to our newsletter.</p>
                    <p style="margin: 0;">
                        <a href="{unsubscribe_link}" style="color: #8224e3; text-decoration: none; font-weight: 500; border-bottom: 1px solid #8224e3; padding-bottom: 1px;">Unsubscribe</a> 
                        <span style="margin: 0 8px; color: #dee2e6;">•</span>
                        <a href="' . esc_url($site_url) . '" style="color: #8224e3; text-decoration: none; font-weight: 500; border-bottom: 1px solid #8224e3; padding-bottom: 1px;">Visit our website</a>
                    </p>
                </div>
            </div>
            
        </div>
        
        <!-- Email Client Compatibility -->
        <div style="text-align: center; margin-top: 20px;">
            <p style="font-size: 12px; color: #9ca3af; margin: 0;">
                If you\'re having trouble viewing this email, <a href="' . esc_url($site_url) . '" style="color: #8224e3;">view it in your browser</a>
            </p>
        </div>
    </div>
</body>
</html>';
    }
    
    public static function get_new_post_template($post) {
        $post_title = get_the_title($post->ID);
        $post_url = get_permalink($post->ID);
        $post_excerpt = has_excerpt($post->ID) ? get_the_excerpt($post->ID) : wp_trim_words(strip_tags($post->post_content), 35);
        $post_date = get_the_date('F j, Y', $post->ID);
        $author_name = get_the_author_meta('display_name', $post->post_author);
        
        // Get featured image with better styling
        $featured_image = '';
        if (has_post_thumbnail($post->ID)) {
            $image_url = get_the_post_thumbnail_url($post->ID, 'large');
            $featured_image = '
            <div style="margin-bottom: 0px; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                <img src="' . esc_url($image_url) . '" alt="' . esc_attr($post_title) . '" style="width: 100%; height: 220px; object-fit: cover; display: block;">
            </div>';
        }
        
        $content = '
        <!-- Header Section -->
        <div style="text-align: center; margin-bottom: 35px;">
            <div style="display: inline-block; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); color: white; padding: 8px 20px; border-radius: 25px; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px;">
                ✨ New Post Alert
            </div>
          
        </div>
        
        <!-- Post Card -->
        <div style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border: 2px solid #e9ecef; border-radius: 15px; overflow: hidden; margin-bottom: 30px; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);">
            ' . $featured_image . '
            <div style="padding: 30px;">
                <!-- Meta Information -->
                <div style="margin-bottom: 20px; font-size: 14px; color: #6c757d; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                    <span style="background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); color: white; padding: 6px 12px; border-radius: 20px; font-weight: 600; margin-right: 15px; font-size: 12px;">' . esc_html($post_date) . '</span>
                    <span style="color: #8224e3; font-weight: 600;">By ' . esc_html($author_name) . '</span>
                </div>
                
                <!-- Post Title -->
                <h3 style="font-size: 24px; font-weight: 700; color: #2c3e50; margin: 0 0 16px 0; line-height: 1.4; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                    <a href="' . esc_url($post_url) . '" style="color: #2c3e50; text-decoration: none;">' . esc_html($post_title) . '</a>
                </h3>
                
                <!-- Post Excerpt -->
                <p style="color: #000000; font-size: 16px; line-height: 1.6; margin: 0 0 25px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">' . esc_html($post_excerpt) . '</p>
                
                <!-- CTA Button -->
                <div style="text-align: center; margin-top: 25px;">
                    <a href="' . esc_url($post_url) . '" style="display: inline-block; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); color: #ffffff !important; padding: 15px 30px; border-radius: 30px; text-decoration: none; font-weight: 700; font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(130, 36, 227, 0.3); transition: all 0.3s ease;">
                        📖 Read Full Article
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Engagement Section -->
        <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 25px; border-radius: 12px; text-align: center; margin-top: 30px; border: 1px solid #e1e8ed;">
            <h4 style="color: #2c3e50; margin: 0 0 15px 0; font-size: 18px; font-weight: 700; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                💜 Stay Connected
            </h4>
            <p style="color: #6c757d; margin: 0; font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.5;">
                Don\'t miss out on our latest updates and exclusive content. Follow us on social media!
            </p>
        </div>';
        
        return self::get_email_wrapper($content, 'New Post: ' . $post_title);
    }
    
    public static function get_welcome_template($email) {
        $site_name = get_bloginfo('name');
        
        $content = '
        <!-- Welcome Header -->
        <div style="text-align: center; margin-bottom: 40px;">
            <div style="display: inline-block; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); color: white; padding: 10px 25px; border-radius: 30px; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 25px;">
                🎉 Welcome Aboard!
            </div>
            <h2 style="color: #2c3e50; font-size: 32px; font-weight: 700; margin: 0 0 15px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                Welcome to Our Community!
            </h2>
            <p style="color: #6c757d; font-size: 18px; margin: 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                Thanks for joining thousands of awesome readers who trust us for quality content!
            </p>
        </div>
        
        <!-- Success Card -->
        <div style="background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); padding: 30px; border-radius: 15px; text-align: center; margin: 30px 0; box-shadow: 0 8px 25px rgba(130, 36, 227, 0.3);">
            <h3 style="color: #ffffff; font-size: 24px; margin: 0 0 15px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; font-weight: 700;">
                ✨ You\'re All Set!
            </h3>
            <p style="color: #ffffff; font-size: 16px; margin: 0; opacity: 0.95; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.5;">
                You\'ll now receive our latest posts, exclusive insights, and premium content directly in your inbox.
            </p>
        </div>
        
        <!-- What to Expect -->
        <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 25px; border-radius: 12px; margin: 30px 0; border: 1px solid #e1e8ed;">
            <h4 style="color: #2c3e50; margin: 0 0 20px 0; text-align: center; font-size: 20px; font-weight: 700; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                🚀 What to Expect
            </h4>
            <div style="display: block;">
                <div style="margin-bottom: 12px; padding: 12px; background: white; border-radius: 8px; border-left: 4px solid #8224e3;">
                    <span style="color: #8224e3; font-weight: 700; margin-right: 10px;">📧</span>
                    <span style="color: #2c3e50; font-weight: 600; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">Weekly newsletter with our best content</span>
                </div>
                <div style="margin-bottom: 12px; padding: 12px; background: white; border-radius: 8px; border-left: 4px solid #8224e3;">
                    <span style="color: #8224e3; font-weight: 700; margin-right: 10px;">⚡</span>
                    <span style="color: #2c3e50; font-weight: 600; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">Instant notifications for new posts</span>
                </div>
                <div style="margin-bottom: 12px; padding: 12px; background: white; border-radius: 8px; border-left: 4px solid #8224e3;">
                    <span style="color: #8224e3; font-weight: 700; margin-right: 10px;">💎</span>
                    <span style="color: #2c3e50; font-weight: 600; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">Exclusive content just for subscribers</span>
                </div>
                <div style="margin-bottom: 0; padding: 12px; background: white; border-radius: 8px; border-left: 4px solid #8224e3;">
                    <span style="color: #8224e3; font-weight: 700; margin-right: 10px;">🎯</span>
                    <span style="color: #2c3e50; font-weight: 600; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">No spam, just quality content</span>
                </div>
            </div>
        </div>
        
        <!-- CTA Button -->
        <div style="text-align: center; margin: 35px 0;">
            <a href="' . esc_url(home_url()) . '" style="display: inline-block; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); color: #ffffff !important; padding: 15px 35px; border-radius: 30px; text-decoration: none; font-weight: 700; font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(130, 36, 227, 0.3);">
                🌟 Explore Our Website
            </a>
        </div>
        
        <!-- Support Section -->
        <div style="text-align: center; margin-top: 40px; padding-top: 30px; border-top: 2px solid #f1f3f4;">
            <p style="color: #6c757d; font-size: 15px; margin: 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.6;">
                <strong>Have questions?</strong> Just reply to this email - we\'d love to hear from you! 💬
            </p>
        </div>';
        
        return self::get_email_wrapper($content, 'Welcome to ' . $site_name);
    }
    
    public static function get_verification_template($verify_link) {
        $site_name = get_bloginfo('name');
        
        $content = '
        <!-- Verification Header -->
        <div style="text-align: center; margin-bottom: 35px;">
            <div style="display: inline-block; background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; padding: 8px 20px; border-radius: 25px; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px;">
                🔐 Verification Required
            </div>
            <h2 style="color: #2c3e50; font-size: 28px; font-weight: 700; margin: 0 0 15px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                Almost There!
            </h2>
            <p style="color: #6c757d; font-size: 16px; margin: 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                Please verify your email address to complete your subscription and start receiving our awesome content.
            </p>
        </div>
        
        <!-- Verification Card -->
        <div style="background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%); border: 2px solid #f39c12; padding: 25px; border-radius: 15px; margin: 30px 0; text-align: center; box-shadow: 0 4px 15px rgba(243, 156, 18, 0.2);">
            <h3 style="color: #856404; margin: 0 0 15px 0; font-size: 22px; font-weight: 700; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                ⚡ One Click Away
            </h3>
            <p style="color: #856404; margin: 0 0 20px 0; font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.5;">
                Click the button below to verify your email and unlock access to our premium content!
            </p>
            <a href="' . esc_url($verify_link) . '" style="display: inline-block; background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: #ffffff !important; padding: 15px 30px; border-radius: 30px; text-decoration: none; font-weight: 700; font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);">
                ✅ Verify My Email
            </a>
        </div>
        
        <!-- Alternative Link -->
        <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 20px; border-radius: 10px; margin: 25px 0; border: 1px solid #e1e8ed;">
            <p style="color: #6c757d; font-size: 14px; margin: 0; text-align: center; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.6;">
                <strong>Can\'t click the button?</strong> Copy and paste this link into your browser:<br>
                <a href="' . esc_url($verify_link) . '" style="color: #8224e3; word-break: break-all; font-size: 13px; text-decoration: none; border-bottom: 1px solid #8224e3;">' . esc_url($verify_link) . '</a>
            </p>
        </div>
        
        <!-- Security Notice -->
        <div style="text-align: center; margin-top: 30px;">
            <p style="color: #6c757d; font-size: 13px; margin: 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                🔒 This verification link will expire in 24 hours for security reasons.
            </p>
        </div>';
        
        return self::get_email_wrapper($content, 'Verify Your Email - ' . $site_name);
    }
    
    public static function get_newsletter_template($subject, $content) {
        $formatted_content = '
        <!-- Newsletter Header -->
        <div style="margin-bottom: 30px; text-align: center;">
            <div style="display: inline-block; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); color: white; padding: 8px 20px; border-radius: 25px; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px;">
                📬 Newsletter
            </div>
            <h2 style="color: #2c3e50; font-size: 28px; font-weight: 700; margin: 0 0 20px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.3;">
                ' . esc_html($subject) . '
            </h2>
        </div>
        
        <!-- Newsletter Content -->
        <div style="background-color: #ffffff; padding: 0; border-radius: 10px; line-height: 1.7; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; font-size: 16px; color: #2c3e50;">
            ' . wp_kses_post($content) . '
        </div>
        
        <!-- Engagement Footer -->
        <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 25px; border-radius: 12px; text-align: center; margin-top: 35px; border: 1px solid #e1e8ed;">
            <h4 style="color: #2c3e50; margin: 0 0 15px 0; font-size: 18px; font-weight: 700; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif;">
                💜 Enjoying Our Content?
            </h4>
            <p style="color: #6c757d; margin: 0 0 20px 0; font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; line-height: 1.5;">
                Share this newsletter with friends who might be interested and help us grow our community!
            </p>
            <a href="' . esc_url(home_url()) . '" style="display: inline-block; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); color: #ffffff !important; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 700; font-size: 14px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(130, 36, 227, 0.3);">
                🌟 Visit Our Website
            </a>
        </div>';
        
        return self::get_email_wrapper($formatted_content, $subject);
    }
    
    private static function get_social_links() {
        $facebook = get_option('wns_facebook_url', '');
        $twitter = get_option('wns_twitter_url', '');
        $instagram = get_option('wns_instagram_url', '');
        $linkedin = get_option('wns_linkedin_url', '');
        
        $social_html = '<div style="margin: 20px 0;">';
        
        if ($facebook) {
            $social_html .= '<a href="' . esc_url($facebook) . '" target="_blank" style="display: inline-block; margin: 0 10px; width: 40px; height: 40px; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); border-radius: 50%; text-align: center; line-height: 40px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 10px rgba(130, 36, 227, 0.3);">f</a>';
        }
        if ($twitter) {
            $social_html .= '<a href="' . esc_url($twitter) . '" target="_blank" style="display: inline-block; margin: 0 10px; width: 40px; height: 40px; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); border-radius: 50%; text-align: center; line-height: 40px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 10px rgba(130, 36, 227, 0.3);">𝕏</a>';
        }
        if ($instagram) {
            $social_html .= '<a href="' . esc_url($instagram) . '" target="_blank" style="display: inline-block; margin: 0 10px; width: 40px; height: 40px; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); border-radius: 50%; text-align: center; line-height: 40px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 10px rgba(130, 36, 227, 0.3);">📷</a>';
        }
        if ($linkedin) {
            $social_html .= '<a href="' . esc_url($linkedin) . '" target="_blank" style="display: inline-block; margin: 0 10px; width: 40px; height: 40px; background: linear-gradient(135deg, #8224e3 0%, #6c1ce0 100%); border-radius: 50%; text-align: center; line-height: 40px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 10px rgba(130, 36, 227, 0.3);">in</a>';
        }
        
        $social_html .= '</div>';
        
        return $social_html;
    }
}