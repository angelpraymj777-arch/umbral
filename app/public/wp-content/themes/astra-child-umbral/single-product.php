<?php
/**
 * Template personalizado para productos WooCommerce
 * 
 * Este archivo sobreescribe single-product.php de WooCommerce
 * cuando existe en el child theme.
 * 
 * Umbral - Tienda de Ropa para Hombres y Mujeres
 */

get_header();

while (have_posts()) :
    the_post();
    global $product;
    ?>
    
    <div class="umbral-product-page">
        
        <!-- Mensaje de prueba para confirmar que carga este template -->
        <div style="background: #fff3cd; padding: 10px 20px; border-left: 4px solid #ffc107; margin-bottom: 20px;">
            <strong>✓ Template personalizado activo:</strong> single-product.php del child theme Umbral
        </div>
        
        <div class="product-container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
            
            <!-- Galería del producto -->
            <div class="product-gallery">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('large', ['style' => 'border-radius: 12px;']);
                } else {
                    echo '<div style="background: #f5f5f5; height: 400px; display: flex; align-items: center; justify-content: center; border-radius: 12px;">Sin imagen</div>';
                }
                ?>
            </div>
            
            <!-- Info del producto -->
            <div class="product-info">
                <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; margin-bottom: 10px; color: #1a1a1a;">
                    <?php the_title(); ?>
                </h1>
                
                <?php if ($product) : ?>
                    <p class="product-price" style="font-size: 1.8rem; color: #c9a962; font-weight: 700; margin: 20px 0;">
                        $<?php echo number_format($product->get_price(), 2); ?>
                    </p>
                    
                    <?php if ($product->get_short_description()) : ?>
                        <div class="product-short-description" style="margin-bottom: 20px;">
                            <?php echo wp_kses_post($product->get_short_description()); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="product-meta" style="margin-bottom: 30px; color: #666;">
                        <?php if ($product->get_sku()) : ?>
                            <p><strong>SKU:</strong> <?php echo esc_html($product->get_sku()); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($product->get_stock_quantity()) : ?>
                            <p><strong>Stock:</strong> <?php echo esc_html($product->get_stock_quantity()); ?> unidades</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="product-actions">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>
                    
                <?php else : ?>
                    <p>Producto no disponible.</p>
                <?php endif; ?>
                
                <!-- Descripción completa -->
                <div class="product-description" style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee;">
                    <h3 style="font-family: 'Playfair Display', serif; color: #1a1a1a;">Descripción</h3>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        
    </div>
    
    <?php
endwhile;

get_footer();