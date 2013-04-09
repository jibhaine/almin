jibhaine/almin
========

stands for Application Lifecycle Management Interface
It is mainly an entry portal / index page / service proxy to centralize several team development tools and informations

it also holds the code for several tools i wanted to create.
* almin :
* engin : a node-based cms / wiki / comment
* dash : a timeline for project infos.
*

# ALMIN

Provides an united interface to several development tools, through their JSON API or via command line calls.
The goal is to provides a main dashboard for evceryone to access their workspace informations.

The application in itselfs does'nt hold any data besides user preferences and data sources.
Core app services should be extensible to include data from any source


## Supported Backend

In the immediate future, here are the few supported third party applications :


### User authentification

* LDAP
* OAuth

### Source file control

* SVN
* GIT

### Continuous Integration

* Jenkins

### Code Quality

* Sonar

### Issue Tracker

* Mantis
* Redmine


## Installation

Dependencies are installed with (composer)[http://getcomposer.org/]
Any php ide should do the trick.

### How to build

  composer install --dev

### How to run tests

  see with your favorite ide.

### How to run site

use php 5.4 embedded web server : php -s


## Plugin howto

the main goal of a almin plugin is to provide data for the front-end

so they  should feed the interface with any of the the following objets
* Project
* User
* Event
* Task
* Story
* Resource
* Document
* Build
* Issue
* Milestone

## FAQ

