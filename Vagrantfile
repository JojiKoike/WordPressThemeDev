# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Dont't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = '2'.freeze

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # Package Cache
  config.cache.scope = :machine if Vagrant.has_plugin?('vagrant-cachier')

  # Development environment
  config.vm.define :develop do |develop|
    develop.omnibus.chef_version = :latest
    develop.vm.hostname = 'wpdevelop'
    develop.vm.box = 'bento/centos-7.3'
    develop.vm.network :private_network, ip: '192.168.33.20'
    develop.vm.synced_folder './application',
                             '/var/www/html',
                             id: 'vagrant-root',
                             nfs: false,
                             owner: 'vagrant',
                             group: 'vagrant',
                             mount_options: ['dmode=777','fmode=777']

    # Provisioning
    develop.vm.provision :chef_solo do |chef|
      # Log lovel setting
      chef.log_level = 'debug'
      # Cookbook location
      chef.cookbooks_path = './chef-repo/cookbooks'
      # Attribute definition for each cookbook
      chef.json = {
        mysql: {
          hostname: 'wpdevelop',
          server_root_password: 'password'
        }
      }
      # Cookbook apply definition
      chef.run_list = %w(
        recipe[yum]
        recipe[yum-epel]
        recipe[common::default]
        recipe[phpenv::default]
        recipe[phpenv::develop]
        recipe[apache::default]
        recipe[mysql::default]
      )
    end
  end
end
