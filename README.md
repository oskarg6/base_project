# Base Project

## Instalación del proyecto

### Introducción

#####Este proyecto funciona con:
 * [Symfony 3.4.7](https://symfony.com/doc/current/index.html)
 * [Vagrant](https://www.vagrantup.com/docs/index.html)
 * [DeployerPHP](https://deployer.org/docs)
 
### Vagrant
 [Vagrant](https://www.vagrantup.com/docs/index.html) lo usamos para generar una máquina virtual con un servidor web, 
 para desarrollar toda nuestra plataforma en un entorno lo más parecido al 
 servidor final.
 La configuración esta en vagrant file, y necesitamos tener instalado Vagrant
 y VirtualBox para poder generar la máquina y arrancarla.
 
 **Los comandos básicos son:**
   * arrancar máquina: `vagrant up` 
   * apagar máquina: `vagrant halt`
   * instalar servidor web: `vagrant provision`
   * destruir máquina: `vagrant destroy`
   
 El archivo de configuración de vagrant es VagrantFile, y se encuentra
 en la raíz del proyecto.
 
 Para instalar todo el programario para hacer el servidor web, necesitamos
 provisionar vagrant con [Ansible](https://docs.ansible.com/). 
 Ansible se instala localmente dentro de la máquina de vagrant, y todas las
 configuraciones del servidor estan dentro de la carpeta ansible, en la 
 raíz del proyecto.
 El archivo principal de ansible es el playbook.yml.
 
 **Ansible instala:**
  * php 5.6
  * apache2
  * mysql
  * phpmyadmin
  * composer
  * ruby
  
### Deployer PHP
Dentro del proyecto de Symfony, se pide [DeployerPHP](https://deployer.org/docs) para desplegar nuestra 
aplicación en los servidores.
Para configurar deployer es necesario que creemos servers.yaml, en la raíz
del proyecto.

```yaml
# servers.yml
master:
  host: 127.0.0.1
  user: user
  deploy_path: /var/www/yoursymfony
  stage: master
  branch: master

development:
  host: 127.0.0.1
  user: user
  deploy_path: /var/www/yoursymfony
  stage: development
  branch: development
```

**Comandos Deployer:**
 * desplegar: `php vendor/deployer/deployer/bin/dep <stage>`
