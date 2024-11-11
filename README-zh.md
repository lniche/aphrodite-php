# Aphrodite Laravel API Scaffold

Aphrodite 是一个基于 [Laravel API Scaffold](https://github.com/redot-src/laravel-api-scaffold) 开发的模板项目，旨在帮助开发者快速上手，深入理解框架的使用流程。该项目提供了全面的示例代码和配置，涵盖了常见的开发场景，以便于学习和实践。此外，Aphrodite 还包含容器部署模板，使得项目在现代云环境中能够轻松部署与管理，助力开发者高效构建和发布应用。

## 技术栈

| 技术                                                                            | 说明                                                                                            |
| ------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- |
| [PHP](https://www.php.net/)                                                     | 必须的 PHP 版本，要求 PHP 8.2 或更高版本。                                                      |
| [guzzlehttp/guzzle](https://github.com/guzzle/guzzle)                           | HTTP 客户端库，用于发送 HTTP 请求，支持 REST API 通信。                                         |
| [laravel/framework](https://github.com/laravel/framework)                       | Laravel 框架核心库，包含了所有的 Laravel 框架功能，如路由、控制器、视图、数据库等。             |
| [laravel/sanctum](https://github.com/laravel/sanctum)                           | 用于 API 认证和授权的 Laravel 包，提供简单的 token 认证机制。                                   |
| [laravel/tinker](https://github.com/laravel/tinker)                             | 交互式命令行工具，用于与 Laravel 应用进行交互，通常用于调试和执行测试。                         |
| [spatie/laravel-query-builder](https://github.com/spatie/laravel-query-builder) | 用于构建 API 查询的包，支持过滤、排序、分页等功能，帮助构建可扩展的查询。                       |
| [fakerphp/faker](https://github.com/FakerPHP/Faker)                             | 用于生成虚拟数据的库，通常用于开发和测试数据填充。                                              |
| [laravel/pint](https://github.com/laravel/pint)                                 | Laravel 的代码风格检查工具，类似于 PHP CodeSniffer，但专门为 Laravel 提供了一些自定义规则。     |
| [laravel/sail](https://github.com/laravel/sail)                                 | Laravel 官方的 Docker 开发环境，简化了开发环境的配置，适用于轻松启动、运行 Laravel 应用的容器。 |
| [mockery/mockery](https://github.com/mockery/mockery)                           | 测试替身库，提供模拟对象（mock objects）功能，用于单元测试中的依赖注入和方法调用模拟。          |
| [nunomaduro/collision](https://github.com/nunomaduro/collision)                 | Laravel 错误处理库，提供更好的错误报告和堆栈追踪，改善开发者体验。                              |
| [phpunit/phpunit](https://phpunit.de/)                                          | PHP 测试框架，广泛用于 PHP 应用的单元测试。                                                     |
| [spatie/laravel-ignition](https://github.com/spatie/laravel-ignition)           | Laravel 错误处理工具，提供更好的错误页面和调试信息，适用于 Laravel 项目中的调试工作。           |
| [laravel/breeze](https://github.com/laravel/breeze)                             | 用于快速启动 Laravel 项目基础认证系统（如登录、注册等）的包，适用于简单的认证功能。             |
| [pestphp/pest](https://pestphp.com/)                                            | 一种现代化、简洁的 PHP 测试框架，提供简洁的语法和优雅的测试功能，旨在替代 PHPUnit。             |
| [pestphp/pest-plugin-laravel](https://pestphp.com/)                             | 为 Pest 提供的 Laravel 插件，集成 Laravel 项目的特性，使得 Laravel 测试更加简洁和有意义。       |

## 特性

- **用户认证与授权**：提供基础的用户登录和权限授权功能。
- **分布式锁**：基于 Redis 实现的分布式锁，保证分布式环境下的资源安全。
- **中间件支持**：内置常用的中间件，包括认证、请求日志、跨域处理等。
- **统一输出格式**：提供简单易用的 API Result 统一输出方式，标准化 API 响应格式，提升接口一致性。
- **API 模块化设计**：支持模块化的 API 设计，易于扩展和维护。
- **Swagger 文档集成**：自动生成 API 文档，便于前端开发和测试。

## 模块说明

```
.
├── app/            # 存放应用程序代码（核心代码）
├── bootstrap/      # 存放框架启动文件
├── config/         # 存放框架和应用程序的配置文件
├── database/       # 存放数据库相关的文件
├── public/         # 公共文件目录（Web 服务器的根目录）
├── resources/      # 存放资源文件，如视图、语言文件、CSS、JS 等
├── routes/         # 存放路由定义文件
├── storage/        # 存放框架生成的文件，如日志文件、缓存文件、会话文件等
├── tests/          # 存放自动化测试代码
└── README.md       # 项目的自述文件
```

## 本地运行

```bash
# 1. 克隆项目代码库
git clone https://github.com/lniche/aphrodite-php.git
cd aphrodite-php

# 2. 配置文件
mv .env.example .env

# 3. 处理依赖
# 确保你已经安装了 PHP 和 Laravel 环境, 推荐使用Herd
composer install

# 4. 初始化数据库
database/init.sql

# 5. 启动服务
php artisan serve
```

## Repo Activity

![Alt](https://repobeats.axiom.co/api/embed/92f87152abeaf234940e0a4979ac2644ab05a54f.svg "Repobeats analytics image")

## 贡献

如果你有任何建议或想法，欢迎创建 Issue 或直接提交 Pull Request。

1. Fork 这个仓库。
2. 创建一个新的分支：

```
git checkout -b feature/your-feature
```

3. 提交你的更改：

```
git commit -m 'Add new feature'
```

4. 推送到你的分支：

```
git push origin feature/your-feature
```

5. 提交 Pull Request。

## 许可证

该项目遵循 MIT 许可证。

## 鸣谢

特别感谢所有贡献者和支持者，您的帮助对我们至关重要！
