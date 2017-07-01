#
# Cookbook Name:: apache
# Recipe:: default
#
# Copyright 2017, georgie.jp
#
# All rights reserved - Do Not Redistribute
#
service 'httpd' do
  action [:enable, :start]
  support_setting = { status: true, restart: true, reload: true}
  supports support_setting
end
