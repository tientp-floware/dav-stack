## Overview
This is a Dockerfile/image to build a container for nginx and php-fpm, with the ability to pull website code from git when the container is created, as well as allowing the container to push and pull changes to the code to and from git. The container also has the ability to update templated files with variables passed to docker in order to update your code and settings. There is support for lets encrypt SSL configurations, custom nginx configs, core nginx/PHP variable overrides for running preferences, X-Forwarded-For headers and UID mapping for local volume support.

If you have improvements or suggestions please open an issue or pull request on the GitHub project page.

## Quick Start
To pull from docker hub:
```
docker pull prefix/dav-stack
```
### Running
To simply run the container:
```
sudo docker run -d prefix/dav-stack
```
To dynamically pull code from git when starting:
```
docker run -d -e 'GIT_EMAIL=email_address' -e 'GIT_NAME=full_name' -e 'GIT_USERNAME=git_username' -e 'GIT_REPO=github.com/project' -e 'GIT_PERSONAL_TOKEN=<long_token_string_here>' prefix/dav-stack:latest
```

You can then browse to ```http://<DOCKER_HOST>``` to view the default install files. To find your ```DOCKER_HOST``` use the ```docker inspect``` to get the IP address (normally 172.17.0.2)

For more detailed examples and explanations please refer to the documentation.
## Documentation

- [Building from source](./docs/building.md)
- [Versioning](./docs/versioning.md)
- [Config Flags](./docs/config_flags.md)
- [Git Auth](./docs/git_auth.md)
  - [Personal Access token](./docs/git_auth.md#personal-access-token)
  - [SSH Keys](./docs/git_auth.md#ssh-keys)
- [Git Commands](./docs/git_commands.md)
 - [Push](./docs/git_commands.md#push-code-to-git)
 - [Pull](./docs/git_commands.md#pull-code-from-git-refresh)
- [Repository layout / webroot](./docs/repo_layout.md)
 - [webroot](./docs/repo_layout.md#src--webroot)
- [User / Group Identifiers](./docs/UID_GID_Mapping.md)
- [Custom Nginx Config files](./docs/nginx_configs.md)
 - [REAL IP / X-Forwarded-For Headers](./docs/nginx_configs.md#real-ip--x-forwarded-for-headers)
- [Scripting and Templating](./docs/scripting_templating.md)
 - [Environment Variables](./docs/scripting_templating.md#using-environment-variables--templating)
- [Lets Encrypt Support](./docs/lets_encrypt.md)
 - [Setup](./docs/lets_encrypt.md#setup)
 - [Renewal](./docs/lets_encrypt.md#renewal)
- [PHP Modules](./docs/php_modules.md)
- [Xdebug](./docs/xdebug.md)
- [Logging and Errors](./docs/logs.md)

## Ref [Harvey](https://gitlab.com/ric_harvey/nginx-php-fpm)