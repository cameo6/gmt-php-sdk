# Changelog

## 0.8.0 (2025-12-10)

Full Changelog: [v0.7.0...v0.8.0](https://github.com/cameo6/gmt-php-sdk/compare/v0.7.0...v0.8.0)

### ⚠ BREAKING CHANGES

* use camel casing for all class properties

### Features

* add `BaseResponse` class for accessing raw responses ([8f42c5c](https://github.com/cameo6/gmt-php-sdk/commit/8f42c5ca17fe112d2dddf31dbd8c0896eea7e983))
* split out services into normal & raw types ([058ff2f](https://github.com/cameo6/gmt-php-sdk/commit/058ff2fbad7d7f6295495a191660eb6262232617))
* use camel casing for all class properties ([c654af6](https://github.com/cameo6/gmt-php-sdk/commit/c654af61ced0c903c3410e5f31fbd5fe2e0376a4))


### Chores

* ensure constant values are marked as optional in array types ([0fad587](https://github.com/cameo6/gmt-php-sdk/commit/0fad58707f63d23f369569a9e6cae4fd27fbfeed))
* **internal:** improve pagination tests ([e1ef9ea](https://github.com/cameo6/gmt-php-sdk/commit/e1ef9ea238cdc324dc796df87001a2a730e6f021))
* switch from `#[Api(optional: true|false)]` to `#[Required]|#[Optional]` for annotations ([22c4c10](https://github.com/cameo6/gmt-php-sdk/commit/22c4c10212a8b0ada0f0b346863aec29203f35e1))
* use `$self = clone $this;` instead of `$obj = clone $this;` ([42d78f1](https://github.com/cameo6/gmt-php-sdk/commit/42d78f1a6f00ee1c897fb174a7a72ec2fecdbf78))

## 0.7.0 (2025-12-08)

Full Changelog: [v0.6.0...v0.7.0](https://github.com/cameo6/gmt-php-sdk/compare/v0.6.0...v0.7.0)

### Features

* **api:** api update ([32f6ec4](https://github.com/cameo6/gmt-php-sdk/commit/32f6ec452bf9ff9ebae50efe04b1a889cd96c580))

## 0.6.0 (2025-12-08)

Full Changelog: [v0.5.0...v0.6.0](https://github.com/cameo6/gmt-php-sdk/compare/v0.5.0...v0.6.0)

### Features

* **api:** add refund repository ([0a85fb2](https://github.com/cameo6/gmt-php-sdk/commit/0a85fb269154e4a5b97be094f2633d6f28d6fff8))

## 0.5.0 (2025-12-08)

Full Changelog: [v0.4.0...v0.5.0](https://github.com/cameo6/gmt-php-sdk/compare/v0.4.0...v0.5.0)

### Features

* **api:** api update ([8974229](https://github.com/cameo6/gmt-php-sdk/commit/897422915ed9fa274dc491b7896839acce889105))

## 0.4.0 (2025-12-08)

Full Changelog: [v0.3.0...v0.4.0](https://github.com/cameo6/gmt-php-sdk/compare/v0.3.0...v0.4.0)

### Features

* **api:** add webhooks endpoint ([86b6b79](https://github.com/cameo6/gmt-php-sdk/commit/86b6b79cac5dd3eb55dfcf3b74a3b27a919e3ac7))

## 0.3.0 (2025-12-08)

Full Changelog: [v0.2.0...v0.3.0](https://github.com/cameo6/gmt-php-sdk/compare/v0.2.0...v0.3.0)

### Features

* allow both model class instances and arrays in setters ([32b27c5](https://github.com/cameo6/gmt-php-sdk/commit/32b27c5abbef8ab4a4cb8a6bca546d5bad245bd8))
* **api:** api update ([68bbe0d](https://github.com/cameo6/gmt-php-sdk/commit/68bbe0da806e0bf9669a055149bcf14af5142483))


### Chores

* be more targeted in suppressing superfluous linter warnings ([5f4fccd](https://github.com/cameo6/gmt-php-sdk/commit/5f4fccd8d5d0cd49d7c5d6aee211ab6789c98826))
* better support for phpstan ([4d21db5](https://github.com/cameo6/gmt-php-sdk/commit/4d21db5d93ea4667e3e44106c499aa057b886562))
* formatting ([5f0b339](https://github.com/cameo6/gmt-php-sdk/commit/5f0b339310dc7f3ee4b129a7abb3d5ed4813ff0f))

## 0.2.0 (2025-11-28)

Full Changelog: [v0.1.0...v0.2.0](https://github.com/cameo6/gmt-php-sdk/compare/v0.1.0...v0.2.0)

### Features

* **api:** fix package name ([8184f0c](https://github.com/cameo6/gmt-php-sdk/commit/8184f0c7d461bdcbd2b5c9347af0c0a04cd0d97c))
* **api:** update composer_package_name ([4cd0228](https://github.com/cameo6/gmt-php-sdk/commit/4cd0228ad2c07c1a5919b3b6e5b5e9b201989b7f))
* **api:** update config ([94a9e07](https://github.com/cameo6/gmt-php-sdk/commit/94a9e07ca5ba31cb3359d52ef2ff47445b43d791))

## 0.1.0 (2025-11-28)

Full Changelog: [v0.0.2...v0.1.0](https://github.com/cameo6/gmt-php-sdk/compare/v0.0.2...v0.1.0)

### Features

* **api:** api update ([a7aefe7](https://github.com/cameo6/gmt-php-sdk/commit/a7aefe712678e810c0500d39aa34f184d87bb0fd))

## 0.0.2 (2025-11-28)

Full Changelog: [v0.0.1...v0.0.2](https://github.com/cameo6/gmt-php-sdk/compare/v0.0.1...v0.0.2)

### Chores

* configure new SDK language ([15b4475](https://github.com/cameo6/gmt-php-sdk/commit/15b4475a0858b2c31a348271631484e16cd5a329))
* update SDK settings ([6e68461](https://github.com/cameo6/gmt-php-sdk/commit/6e68461d8850ca8fe5e06f6eff57460bffc910cb))
