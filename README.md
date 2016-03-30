jibhaine/almin
========

stands for Application Lifecycle Management Interface
It is mainly an entry portal / index page / service proxy to centralize several team development tools and informations


# ALMIN

Provides an united interface to several development tools, through their JSON API or via command line calls.
The goal is to provides a main dashboard for evceryone to access their workspace informations.

The application in itselfs does'nt hold any data besides user preferences and data sources.
Core app services should be extensible to include data from any source

## Supported Tools

### Source Control Management
### Continuous integration
* [Jenkins](https://wiki.jenkins-ci.org/display/JENKINS/Remote+access+API)
* [Travis](https://docs.travis-ci.com/api)
### Issues
* [Redmine](http://www.redmine.org/projects/redmine/wiki/Rest_api)
* [TFS](https://www.visualstudio.com/en-us/integrate/api/overview)
* [JIRA](https://docs.atlassian.com/jira/REST/latest/)
* [GitHub](https://developer.github.com/v3/)
* [BitBucket](https://developer.atlassian.com/static/rest/bitbucket-server/4.4.1/bitbucket-rest.html)

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

