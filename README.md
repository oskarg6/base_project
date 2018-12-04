# Base Project

## Instalación del proyecto

### Introducción

##### Este proyecto funciona con:
 * [Symfony 3.4.7](https://symfony.com/doc/current/index.html)
 * [Vagrant](https://www.vagrantup.com/docs/index.html)
 * [DeployerPHP](https://deployer.org/docs)
 * [phpMyAdmin](https://www.phpmyadmin.net/)
 
### Vagrant
 [Vagrant](https://www.vagrantup.com/docs/index.html) se usa para generar una máquina virtual con un servidor web, 
 para desarrollar toda nuestra plataforma en un entorno lo más parecido al 
 servidor final.
 La configuración esta en `VagrantFile`, y se necesita tener instalado Vagrant
 y VirtualBox para poder generar la máquina y arrancarla.
 
###### HostManager
 Es necesario instalar hostmanager  con este comando
 `vagrant plugin install vagrant-hostmanager`
 
 **Los comandos básicos son:**
   * arrancar máquina: `vagrant up` 
   * apagar máquina: `vagrant halt`
   * instalar servidor web: `vagrant provision`
   * destruir máquina: `vagrant destroy`
   
 El archivo de configuración de vagrant es `VagrantFile`, y se encuentra
 en la raíz del proyecto.
 
 Para instalar todo el programario para hacer el servidor web, se necesita
 provisionar vagrant con [Ansible](https://docs.ansible.com/). 
 Ansible se instala localmente dentro de la máquina de vagrant, y todas las
 configuraciones del servidor estan dentro de la carpeta ansible, en la 
 raíz del proyecto.
 El archivo principal de ansible es el `playbook.yml`.
 
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
Para configurar deployer es necesario que se cree `servers.yaml`, en la raíz
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
 * desplegar: `php vendor/deployer/deployer/bin/dep deploy <stage>`
 
 **Bundles instalados en el proyecto**
  * [sonata admin](https://sonata-project.org/bundles/admin/3-x/doc/index.html)
  * [sonata media bundle](https://sonata-project.org/bundles/media/3-x/doc/index.html)
  * [sonata classification bundle](https://sonata-project.org/bundles/classification/2-x/doc/reference/introduction.html)
  * [sonata user bundle](https://sonata-project.org/bundles/user/4-x/doc/index.html)
  * [fos ckeditor](https://symfony.com/doc/current/bundles/FOSCKEditorBundle/installation.html)
  * [KNP DoctrineBehaviors](https://github.com/KnpLabs/DoctrineBehaviors)
  * [a2lix reanslation form](https://a2lix.fr/bundles/translation-form/2.x.html)
  
### Una vez instalado
 Una vez instalado, puedes ver si el proyecto funciona correctamente mirando la url: [`http://base-project.test/`](http://base-project.test/)
 
 Para acceder a phpMyAdmin del proyecto se ha de ir a esta url: [`http://base-project.test/phpmyadmin/`](http://base-project.test/phpmyadmin/)
 
 ##### Posible errores
 Si tienes errores para generar los archivos de `var/cache` o `var/logs`, [symfony lo tiene documentado en su web](https://symfony.com/doc/3.3/setup/file_permissions.html)
 
 #### Personalizar el proyecto
 ##### Personalizar la máquina virtual
 Para personalizar el nombre de la máquina virtual para que no existan 2 con el mismo nombre en tu host, hay que modificar el `VagrantFile`.
 - Cambiar en la línia 13 el valor de `--name`, substituir `base-project-vm` por el nombre de la máquina que deseemos.
 - Cambiar en la línia 22 `base-project-vm` por el nombre que hayamos escrito antes en la línia 13.
 - Cambiar en la línia 27 el valor de `node.vm.hostname` por el dominio que queramos utilizar. 
 
 ##### Variables de entorno
 Para personalizar las variables del entorno como el nombre de la base de datos o el dominio para ver el proyecto, se han de modificar las variables que usa Ansible para crear el entorno web en el servidor.
 El fichero de variables es `/ansible/vars/all.yml`
 
 ###### modificar el dominio
 Para modificar el dominio hay que cambiar las variables de apache que es quien nos genera el vhost. Se ha de cambiar la variable `apache.servername` donde le daremos el valor que haya en la configuración de Vagrant en `VagrantFile` línia 27.
 
 ###### modificar la base de datos
 Hay que modificar las variables: 
 - `mysql.database`: para cambiar el nombre de la base de datos
 - `mysql.user`: para modificar el usuario de la base de datos
 - `mysql.password`: para modificar la contraseña
 
 ##### Personalizar Deployer
 Para desplegar la aplicación desde deployerPHP es necesario que se rellene la configuración en `/servers.yml`. Y se ha de crear el fichero `/usergit.php` con las variables `$user` y `$password`. Este fichero `usergit.php` esta vigilado por el `.gitignore` asi que nunca se subirá a tu repositorio. 
 
  
