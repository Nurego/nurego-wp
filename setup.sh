#!/bin/bash

################################################
#   Script that transfers changes from the git
#   repo to the official WordPress svn repo
################################################

# Check appropriate tools are installed
command -v svn >/dev/null 2>&1 || { echo "[!!!]Subversion must be installed but wasn't found." >&2; exit 1; }
command -v git >/dev/null 2>&1 || { echo "[!!!]Git must be installed but wasn't found." >&2; exit 1; }

# Move to a safe place
cd /tmp/

# Clone the SVN version of the repo
svn co http://plugins.svn.wordpress.org/nurego-wp

# Clone the git version of the repo
git clone https://github.com/Nurego/nurego-wp gitnurego-wp

# Store the version number for svn commit message
cd gitnurego-wp
$version=$(less nurego-wp.php | grep "Version")
echo "[!!!] Found new version number"

# Clean the svn trunk and move the new files
rm -rf ../nurego-wp/trunk*
mv * ../nurego-wp/trunk/
cd ../nurego-wp/
svn add trunk/*

# Commit and push up
svn ci -m "$version"

# Clean up!
cd /tmp/
rm -rf nurego-wp gitnurego-wp

echo "####################################"
echo "  Successfully updated plugin!      "
echo "####################################"
