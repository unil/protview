#!/bin/sh

###############################################################################
# Configuration
#

# Directories
phpdoc_dir=../app/lib/xfm/scripts/docs/PhpDocumentor
base_dir=../app
source_dir=$base_dir/lib
output_dir=$base_dir/docs/api/trunk

# Title
title="ProtView API Documentation"

###############################################################################
# Processing
#

# Empties output directory
rm -rf $output_dir/*

# Generates HTML Documentation
php $phpdoc_dir/phpdoc -o HTML:frames:earthli -d $source_dir -t $output_dir -dn xFreemwork -s -ti "$title" > /dev/null

# Renames files (PhpDocumentor bug?)
# - *.cs -> *.css
# - *.pn -> *.png
find $output_dir/media -iname *.cs -exec mv {} {}s \;
find $output_dir/media -iname *.pn -exec mv {} {}g \;

