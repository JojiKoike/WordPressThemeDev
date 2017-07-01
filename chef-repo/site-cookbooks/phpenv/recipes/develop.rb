#
# Cookbook Name:: phpenv
# Recipe:: develop
#
# Copyright 2017, app-tsukurouze.com
#
# All rights reserved - Do Not Redistribute
#

#  Install applications
%w(php-xdebug).each do |p|
  package p do
    action :install
  end
end
