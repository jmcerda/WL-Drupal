# Contributing

## Table of Contents
1. [About the Project](#about-the-project)
1. [Project Status](#project-status)
1. [Getting Started](#getting-started)
1. [Code Workflow](#code-workflow)
1. [Configuration Workflow](#configuration-workflow)

# About the Project

# Project Status

# Getting Started

##### Important - If your project is for a new agency site, fork a copy of the code base [here](https://github.com/jmcerda/WL-Drupal/fork), using the project title as a naming convention.


# Code Workflow
#### Overall Git workflow rules.

1. A develop branch is created from master
1. A release branch is created from develop
1. Feature branches are created from develop
1. When a feature is complete it is merged into the develop branch
1. When the release branch is done it is merged into develop, and then master via a pull request
1. If an issue in master is detected a hotfix branch is created from master
1. Once the hotfix is complete it is merged to both develop, and then master via a pull request

#### Branches
##### Feature Branches
When working on an existing site, each new feature should reside in its own branch which can be pushed to the central repository for backup/collaboration. But, instead of branching off of master, feature branches use develop as their parent branch. When a feature is complete, it gets merged back into develop. **Features should never interact directly with master.**

Feature branches are **ALWAYS** created off to the latest develop branch.

###### Creating a feature branch

`git checkout develop`

`git checkout -b feature/FEATURE_BRANCH`

Continue your work and use Git like you normally would.

###### Finishing a feature branch

When you’re done with the development work on the feature, the next step is to merge the feature_branch into develop.

`git checkout develop`

`git merge feature/FEATURE_BRANCH`

##### Release Branches

###### Starting a release branch

Once develop has acquired enough features for a release (or a predetermined release date is approaching), you fork a release branch off of develop. Creating this branch starts the next release cycle, so no new features can be added after this point—only bug fixes, documentation generation, and other release-oriented tasks should go in this branch. Once it's ready to ship, the release branch gets merged into master and tagged with a version number. In addition, it should be merged back into develop, which may have progressed since the release was initiated.

Like feature branches, release branches are based on the develop branch.

`git checkout develop`

` git checkout -b release/0.1.0`

###### Finishing a release branch

Once the release is ready to ship, it will get merged it into master and develop, then the release branch will be deleted. It’s important to merge back into develop because critical updates may have been added to the release branch and they need to be accessible to new features.

**It is essential to initiate a pull request to merge the release into master.**

##### Hotfix Branches

Maintenance or “hotfix” branches are used to quickly patch production releases. **Hotfix branches are based on master instead of develop.** This is the only branch that should fork directly off of master. As soon as the fix is complete, it should be merged into both master and develop (or the current release branch), and master should be tagged with an updated version number.

###### Starting a hotfix branch

`git checkout master`

 `git checkout -b hotfix/HOTFIX_BRANCH`

###### Finishing a hotfix branch
Similar to finishing a release branch, a hotfix branch gets merged into both master and develop.

`git checkout master`

`git merge hotfix/HOTFIX_BRANCH`

`git checkout develop`

`git merge hotfix/HOTFIX_BRANCH`

`git branch -D hotfix/HOTFIX_BRANCH`


# Configuration Workflow notes.

At its most basic it could just say that contributions are welcome if they follow our development standards, linking off to a wiki page describing those or something. When I think about documentation about contributing to a project, I think the most useful thing is saying what someone needs to do if they want to contribute back to the project, vs necessarily what development workflow they need to follow.

IMO, I think that configuration and code should always flow up from local to dev to qa to prod, and DB should always flow down in the other direction.

The config in the DB shouldn't matter, the only thing we would be pulling down a copy of the DB for would be to update content in another environment. Config changes should have already been made locally, exported, committed, and deployed live, then when you pull the DB down, the only difference should be any content changes.

But either way since the config is managed in code, even if you pull down a copy of the live DB with different config, you can run a config import to make it match what's in the code. Or if for some reason config changes were made on live that need to be kept, the DB can be pulled down, then the config exported.

I think documentation about the workflow would be a good step so that we can make sure everyone understands it and can reference it. Maybe even with diagrams or something if needed. We can have workflows for any possible scenario, like making a new config change from scratch, deploying existing config changes live, merging config from live to local, etc
