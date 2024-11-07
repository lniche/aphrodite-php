# Aphrodite Rails API Scaffold

Aphrodite 是一个基于 [Rails](https://rubyonrails.org) 开发的模板项目，旨在帮助开发者快速上手，深入理解框架的使用流程。该项目提供了全面的示例代码和配置，涵盖了常见的开发场景，以便于学习和实践。此外，Aphrodite 还包含容器部署模板，使得项目在现代云环境中能够轻松部署与管理，助力开发者高效构建和发布应用。

## 技术栈

| 技术                                                      | 说明                                           |
| --------------------------------------------------------- | ---------------------------------------------- |
| [tokio](https://github.com/tokio-rs/tokio)                | 异步运行时，支持多种异步功能和全特性           |
| [clap](https://github.com/clap-rs/clap)                   | 命令行参数解析库，支持衍生宏                   |
| [thiserror](https://github.com/dtolnay/thiserror)         | 错误处理库，提供简洁的错误定义                 |
| [anyhow](https://github.com/dtolnay/anyhow)               | 灵活的错误处理库，适用于简化错误传播           |
| [base64](https://crates.io/crates/base64)                 | Base64 编码和解码库                            |
| [time](https://crates.io/crates/time)                     | 时间处理库，支持宏、本地时区、格式化和解析功能 |
| [serde](https://serde.rs/)                                | 数据序列化和反序列化库，支持衍生宏             |
| [serde_json](https://crates.io/crates/serde_json)         | JSON 数据序列化和反序列化库                    |
| [tracing](https://github.com/tokio-rs/tracing)            | 异步应用日志框架                               |
| [tracing-subscriber](https://github.com/tokio-rs/tracing) | 日志订阅者，支持 JSON 格式                     |

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
├── app/                # 应用核心代码
├── bin/                # 可执行脚本
├── config/             # 配置文件
├── db/                 # 数据库相关
├── deploy/             # 部署相关文件
├── docs/               # 项目文档
├── lib/                # 自定义库文件
├── public/             # 公共资源
├── storage/            # 文件存储
├── test/               # 测试文件
├── tmp/                # 临时文件
├── vendor/             # 第三方代码
└── README.md           # 项目说明
```

## 本地运行

```bash
# 1. 克隆项目代码库
git clone https://github.com/lniche/aphrodite-rb.git
cd aphrodite-rb

# 2. 配置文件
cd config
mv .env.example .env

# 3. 处理依赖
# 确保你已经安装了 Ruby 和 Rails 环境
bundle install

# 4. 初始化数据库
deploy/db.sql

# 5. 启动服务
bin/rails server
```

## 贡献

如果你有任何建议或想法，欢迎创建 Issue 或直接提交 Pull Request。

1. Fork 这个仓库。
2. 创建一个新的分支：git checkout -b feature/your-feature
3. 提交你的更改：git commit -m 'Add new feature'
4. 推送到你的分支：git push origin feature/your-feature
5. 提交 Pull Request。

## 许可证

该项目遵循 MIT 许可证。

## 鸣谢

特别感谢所有贡献者和支持者，您的帮助对我们至关重要！
