<?php
include 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'Store - FAMOUS GAMING';
$allowed_categories = [
    'PlayStation Consoles',
    'Controllers',
    'Games / CDs',
    'Controller Covers',
    'PlayStation Accessories'
];

$selected_category = isset($_GET['category']) ? sanitize_input($_GET['category']) : '';
if (!in_array($selected_category, $allowed_categories, true)) {
    $selected_category = '';
}

$store_ready = false;
$products = [];

$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'store_products'");
if ($table_check && mysqli_num_rows($table_check) > 0) {
    $store_ready = true;
    $stmt = mysqli_prepare(
        $conn,
        "SELECT id, product_name, category, price, description, image_path, stock_quantity, status
         FROM store_products
         WHERE status = 'Active'
         ORDER BY created_at DESC, id DESC"
    );

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
    }
}

include 'includes/header.php';
?>

<section class="hero store-hero"> 
    <div class="container">
        <div class="store-hero-shell">
            <div class="store-hero-copy">
                <span class="store-eyebrow">Gaming Store</span>
                <h1>Premium PlayStation Gear for Every Setup</h1>
                <p>Discover consoles, controllers, games, covers, and essential accessories curated for a modern gaming center experience.</p>
            </div>
            <div class="store-hero-panel">
                <div class="store-hero-stat">
                    <strong>5</strong>
                    <span>Core product categories</span>
                </div>
                <div class="store-hero-stat">
                    <strong>DB</strong>
                    <span>Live products from your store system</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content store-content">
    <div class="container">
        <div class="store-toolbar">
            <div>
                <h2 class="section-title store-section-title">Explore The Store</h2>
                <p class="store-toolbar-text">Filter by category and browse the latest products available at FAMOUS GAMING.</p>
            </div>
            <div class="store-filter-chips" id="storeFilterChips">
                <a href="store.php" class="store-filter-chip <?php echo $selected_category === '' ? 'active' : ''; ?>" data-store-filter="all">All Products</a>
                <?php foreach ($allowed_categories as $category): ?>
                    <a
                        href="store.php?category=<?php echo urlencode($category); ?>"
                        class="store-filter-chip <?php echo $selected_category === $category ? 'active' : ''; ?>"
                        data-store-filter="<?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?>"
                    >
                        <?php echo htmlspecialchars($category); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (!$store_ready): ?>
            <div class="store-empty-state">
                <h3>Store setup is not ready yet</h3>
                <p>Run the updated database schema to create the new <code>store_products</code> table and publish products here.</p>
            </div>
        <?php elseif (empty($products)): ?>
            <div class="store-empty-state">
                <h3>No products found</h3>
                <p>There are no active products in this category right now. Try another filter or add items from the admin panel.</p>
            </div>
        <?php else: ?>
            <div class="row g-4 store-grid" id="storeProductsGrid">
                <?php foreach ($products as $product): ?>
                    <?php
                    $has_image = !empty($product['image_path']) && file_exists(__DIR__ . '/' . $product['image_path']);
                    $is_in_stock = ((int)$product['stock_quantity'] > 0);
                    $stock_label = !$is_in_stock ? 'Out of Stock' : (((int)$product['stock_quantity'] <= 5) ? 'Limited Stock' : 'In Stock');
                    $stock_class = !$is_in_stock ? 'store-stock-out' : (((int)$product['stock_quantity'] <= 5) ? 'store-stock-limited' : 'store-stock-in');
                    ?>
                    <div class="col-12 col-md-6 col-xl-4" data-store-card data-store-category="<?php echo htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8'); ?>">
                        <article class="store-product-card h-100">
                            <div class="store-product-media">
                                <?php if ($has_image): ?>
                                    <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="img-fluid">
                                <?php else: ?>
                                    <div class="store-product-placeholder" aria-hidden="true">
                                        <span>FG</span>
                                    </div>
                                <?php endif; ?>
                                <span class="store-category-badge"><?php echo htmlspecialchars($product['category']); ?></span>
                            </div>

                            <div class="store-product-body">
                                <div class="store-product-meta">
                                    <span class="store-stock-badge <?php echo $stock_class; ?>"><?php echo $stock_label; ?></span>
                                    <span class="store-stock-qty"><?php echo (int)$product['stock_quantity']; ?> in stock</span>
                                </div>
                                <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                                <p><?php echo htmlspecialchars($product['description']); ?></p>
                                <div class="store-product-footer">
                                    <div class="store-price"><?php echo number_format($product['price'], 2); ?> JOD</div>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="store-empty-state store-empty-state-filtered" id="storeFilteredEmptyState" hidden>
                <h3>No products found</h3>
                <p>There are no active products in this category right now. Try another filter to keep browsing.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if ($store_ready && !empty($products)): ?>
<script>
    (function () {
        const filterContainer = document.getElementById('storeFilterChips');
        const cards = Array.from(document.querySelectorAll('[data-store-card]'));
        const filteredEmptyState = document.getElementById('storeFilteredEmptyState');
        const initialFilter = <?php echo json_encode($selected_category === '' ? 'all' : $selected_category); ?>;

        if (!filterContainer || cards.length === 0) {
            return;
        }

        function applyFilter(filterValue) {
            let visibleCount = 0;

            cards.forEach(function (card) {
                const matches = filterValue === 'all' || card.dataset.storeCategory === filterValue;
                card.hidden = !matches;

                if (matches) {
                    visibleCount += 1;
                }
            });

            Array.from(filterContainer.querySelectorAll('.store-filter-chip')).forEach(function (chip) {
                chip.classList.toggle('active', chip.dataset.storeFilter === filterValue);
            });

            if (filteredEmptyState) {
                filteredEmptyState.hidden = visibleCount !== 0;
            }
        }

        filterContainer.addEventListener('click', function (event) {
            const chip = event.target.closest('.store-filter-chip');

            if (!chip) {
                return;
            }

            event.preventDefault();
            applyFilter(chip.dataset.storeFilter || 'all');
        });

        applyFilter(initialFilter);
    })();
</script>
<?php endif; ?>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>
