#
# Cookbook Name:: apache
# Recipe:: default
#
# Copyright 2017, georgie.jp
#
# All rights reserved - Do Not Redistribute
#
service 'httpd' do
  action [:enable]
  support_setting = { status: true, restart: true, reload: true}
  supports support_setting
end
# For mod rewirte setting
template '/etc/httpd/conf/httpd.conf' do
  owner 'root'
  group 'root'
  mode 0o644
  action :create
  notifies :start, 'service[httpd]', :delayed
end
