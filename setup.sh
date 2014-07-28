#!/bin/bash
: '
Script that transfers changes from the git repo to the 
official WordPress svn repo. Make sure to update the Stable
tag version to the currect version of the plugin.

The script creates a svn tag for whatever the Stable tag is in
the README.txt. 

Also, have your WordPress password handy.
'
# Check appropriate tools are installed
command -v svn >/dev/null 2>&1 || { echo "[!!!] Subversion must be installed but wasn't found." >&2; exit 1; }
command -v git >/dev/null 2>&1 || { echo "[!!!] Git must be installed but wasn't found." >&2; exit 1; }

# Move to a safe place
cd /tmp/

# Clone the SVN version of the repo
svn co http://plugins.svn.wordpress.org/nurego-wp

# Clone the git version of the repo
git clone https://github.com/Nurego/nurego-wp gitnurego-wp

# Store the version number for svn commit message
# The spacing with the cut command is important
# Stable tag should always have 1 space after ':'
# in README
#
# Ex:
# Stable tag: 1.0.0
cd gitnurego-wp
version_tag=$(less nurego-wp.php | grep Stable)
version_number=$(echo $version_tag | cut -c 15-) 
echo "[***] Found new version number:"
echo "[***] $version_number"

# Clean the svn trunk and move the new files
# Removing setup.sh and tagging the correct
# release
rm -rf ../nurego-wp/trunk*
mv * ../nurego-wp/trunk/
rm ../nurego-wp/trunk/setup.sh
cd ../nurego-wp/
svn add trunk/*
svn cp trunk tags/${version}


# Get username to use b/c subversion is stupid weird about
# usernames
echo "[!!!] Enter WordPress username:"
read username

# Commit and push up
svn ci --username $username -m "$version_number"

# Clean up!
cd /tmp/
rm -rf nurego-wp gitnurego-wp

echo "####################################"
echo "#   Successfully updated plugin!   #"
echo "####################################"
