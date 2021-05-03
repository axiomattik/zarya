#!/bin/bash


# replace text domain
read -p "Enter Text Domain (e.g. awesome-theme): " textdomain;
find ./src -type f -name "*.php" | xargs sed -i "s/'_s'/'${textdomain}'/g";
sed -i "s/Text Domain: _s/Text Domain: ${textdomain}/" ./src/sass/style.scss;
sed -i "s/Text Domain: _s/Text Domain: ${textdomain}/" ./src/sass/woocommerce.scss;

# replace function name prefix
read -p "Enter function prefix (without trailing underscore, e.g. awesome_theme): " funcpre;
find ./src -type f -name "*.php" | xargs sed -i "s/_s_/${funcpre}_/g";

# replace DocBlocks
read -p "DocBlock slug (e.g. Awesome_Theme): " docblock;
find ./src -type f -name "*.php" | xargs sed -i "s/ _s/ ${docblock}/g";

# replace prefixed handles
read -p "Enter handles prefix (without trailing hyphen, e.g. awesome-theme): " handlesprefix;
find ./src -type f -name "*.php" | xargs sed -i "s/_s-/${handlesprefix}-/g";

# replace constants
read -p "Enter constants prefix (without trailing underscore, e.g. AWESOME_THEME): " constantprefix;
find ./src -type f -name "*.php" | xargs sed -i "s/_S_/${constantprefix}_/g";

echo "Done. Now update the headers in style.scss, woocommerce.scss and the links in footer.php."
