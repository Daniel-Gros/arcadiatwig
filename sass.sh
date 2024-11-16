#!/bin/bash
 # Compile SASS to CSS CLASSER LES FICHIERS PAR ORDRE ALPHABÉTIQUE

sass assets/styles/sass/_base.scss assets/styles/css/_base.css
sass assets/styles/sass/_reset.scss assets/styles/css/_reset.css
sass assets/styles/sass/_typography.scss assets/styles/css/_typography.css


sass assets/styles/sass/_banniere.scss assets/styles/css/_banniere.css
sass assets/styles/sass/_button.scss assets/styles/css/_button.css
sass assets/styles/sass/_card.scss assets/styles/css/_card.css
sass assets/styles/sass/_form.scss assets/styles/css/_form.css
sass assets/styles/sass/_footer.scss assets/styles/css/_footer.css
sass assets/styles/sass/_navbar.scss assets/styles/css/_navbar.css
sass assets/styles/sass/_stars.scss assets/styles/css/_stars.css



sass assets/styles/sass/_functions.scss assets/styles/css/_functions.css
sass assets/styles/sass/_mixins.scss assets/styles/css/_mixins.css
sass assets/styles/sass/_variables.scss assets/styles/css/_variables.css

sass assets/styles/sass/main.scss assets/styles/css/main.css 

php bin/console asset-map:compile
# chmod +x sass.sh
# ./sass.sh