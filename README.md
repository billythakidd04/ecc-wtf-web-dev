# ecc-wtf-web-dev

These are the materials for my web development course at ECC for workforce development

## Useful filesystem commands

**Note** Always try to use tab whenever possible, it saves on spelling errors and helps you move faster

- `cd`: change directory
  - `cd ~` will put you into your home directory
  - `cd /some/file/path/to/some/directory` will put you in to the folder path you described
- `ls`: list directory contents
  - `ls -a` lists all contents *including* hidden files
  - `ls -l` lists all files and shows information about them such as modified date and size
  - `ls /` will show "normal" files in your root directory
  - combining all of these you could show all files in the root, and the data about them using `ls -la /`
- `cp`: copy
  - `cp -r /source/directory/name/ /destination/directory/` will copy the content of source to destination
  - `cp file_1 new_file` will make a copy of *file_1* named *new_file*
- `mv`: moves and renames files and directories
  - `mv directory1/ /some/other/directory/location/` will move the *directory* into the destination provided
  - `mv file_name newFileName` will rename *file_name* to *newFileName*

## Useful git commands

**Note:** You have to be in a git repository (directory) to use git commands

- `git status`: shows you the current status including branch and file status
- `git checkout branch-name`: will check you out to a branch called *branch-name*
- `git checkout -b branch-name`: will *create* and check you out to a branch called *branch-name*
- `git add filename`: will stage the changes in *filename* to be committed
- `git add .`: will stage the changes in *all files* to be committed
- `git commit -am "this is where you message goes"`: will stage and commit all files that are currently tracked by git

## Git Workflow

### First you need to clone the repo

`git clone url`
`cd <repository name>`

### Then follow the same workflow every time

1. `git checkout -b <name-of-branch>`
1. create and update some files
1. `git status`
1. `git add <filename(s)>`
1. `git commit -m "the message that identifies what changes were made"`
1. `git push -u origin <name-of-branch>`
1. create a pull request
1. add a reviewer to the pull request
1. assign yourself to the pull request
1. **once approved** merge the request into main/master
1. `git checkout main/master`
1. `git pull -p`
