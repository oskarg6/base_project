Vagrant.require_version '>= 1.8.5'

Vagrant.configure('2') do |config|
    config.hostmanager.enabled = true
    config.hostmanager.manage_host = true
    config.hostmanager.manage_guest = true

    config.ssh.forward_agent = true

    config.vm.provider :virtualbox do |v|
        v.customize [
            'modifyvm', :id,
            '--name', 'base-project-vm',
            '--cpus', 1,
            '--memory', 3072,
            '--natdnshostresolver1', 'on',
            '--nictype1', 'virtio',
            '--nictype2', 'virtio',
        ]
    end

    config.vm.define 'base-project-vm' do |node|
        node.vm.box = 'ubuntu/xenial64'
        node.vm.network :private_network, ip: '192.168.33.99', nic_type: 'virtio'
        node.vm.network :forwarded_port, host: 5000, guest: 5000, auto_correct: true
        node.vm.network :forwarded_port, host: 5001, guest: 5001, auto_correct: true
        node.vm.hostname = 'base-project.test'

        node.vm.synced_folder './', '/vagrant', type: 'virtualbox'
        node.ssh.forward_agent = true
    end

    # para poder usar git con ssh, copia el ssh de mi ruta host y lo pega en el guest
      #config.vm.provision "file", source: "~/.ssh/id_rsa", destination: "/home/ubuntu/.ssh/id_rsa"
      #config.vm.provision "file", source: "~/.ssh/id_rsa.pub", destination: "/home/ubuntu/.ssh/id_rsa.pub"

    config.vm.provision 'ansible_local' do |ansible|
        ansible.playbook = 'ansible/playbook.yml'
        #  ansible.vault_password_file = '/home/ubuntu/.vault_pass'
        #  ansible.vault_password_file = '.vault_pass'
    end
end