## Overview
This is a Dockerfile/image to build a container for nginx and php-fpm, with the ability to pull website code from git when the container is created, as well as allowing the container to push and pull changes to the code to and from git. The container also has the ability to update templated files with variables passed to docker in order to update your code and settings. There is support for lets encrypt SSL configurations, custom nginx configs, core nginx/PHP variable overrides for running preferences, X-Forwarded-For headers and UID mapping for local volume support.

If you have improvements or suggestions please open an issue or pull request on the GitHub project page.

## Quick Start
To pull from docker hub:
```
docker pull nginx-php:latest
```
### Running
To simply run the container:
```
sudo docker run -d prefix/nginx-php
```
To dynamically pull code from git when starting:
```
docker run -d -e 'GIT_EMAIL=email_address' -e 'GIT_NAME=full_name' -e 'GIT_USERNAME=git_username' -e 'GIT_REPO=github.com/project' -e 'GIT_PERSONAL_TOKEN=<long_token_string_here>' prefix/nginx-php:latest
```

You can then browse to ```http://<DOCKER_HOST>``` to view the default install files. To find your ```DOCKER_HOST``` use the ```docker inspect``` to get the IP address (normally 172.17.0.2)

For more detailed examples and explanations please refer to the documentation.
## Documentation

- [Building from source](./nginx-php/docs/building.md)
- [Versioning](./nginx-php/docs/versioning.md)
- [Config Flags](./nginx-php/docs/config_flags.md)
- [Git Auth](./nginx-php/docs/git_auth.md)
  - [Personal Access token](./nginx-php/docs/git_auth.md#personal-access-token)
  - [SSH Keys](./nginx-php/docs/git_auth.md#ssh-keys)
- [Git Commands](./nginx-php/docs/git_commands.md)
 - [Push](./nginx-php/docs/git_commands.md#push-code-to-git)
 - [Pull](./nginx-php/docs/git_commands.md#pull-code-from-git-refresh)
- [Repository layout / webroot](./nginx-php/docs/repo_layout.md)
 - [webroot](./nginx-php/docs/repo_layout.md#src--webroot)
- [User / Group Identifiers](./nginx-php/docs/UID_GID_Mapping.md)
- [Custom Nginx Config files](./nginx-php/docs/nginx_configs.md)
 - [REAL IP / X-Forwarded-For Headers](./nginx-php/docs/nginx_configs.md#real-ip--x-forwarded-for-headers)
- [Scripting and Templating](./nginx-php/docs/scripting_templating.md)
 - [Environment Variables](./nginx-php/docs/scripting_templating.md#using-environment-variables--templating)
- [Lets Encrypt Support](./nginx-php/docs/lets_encrypt.md)
 - [Setup](./nginx-php/docs/lets_encrypt.md#setup)
 - [Renewal](./nginx-php/docs/lets_encrypt.md#renewal)
- [PHP Modules](./nginx-php/docs/php_modules.md)
- [Xdebug](./nginx-php/docs/xdebug.md)
- [Logging and Errors](./nginx-php/docs/logs.md)

## Ref [Harvey](https://gitlab.com/ric_harvey/nginx-php-fpm)