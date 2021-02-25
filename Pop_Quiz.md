Pop Quiz

1. If my project folder is in my home directory, give me a cli command to get to it from anywhere
cd ~

1. I have made changes to 4 files in my project, I want to add all of those changes, what it the correct command to use?
git add . or git commit -am (assuming all files are tracked by git)

1. I have made changes to 4 (a,b,c, & d) files in my project, I want to add the changes from all but one of those files (c), what it the correct command to use?
git add a b d

1. Explain what mv does and give an example of how to use it.
mv moves and/or renames files and directories. ex: mv -r ~/Documents/testDir ~/Desktop/newDir/testDir

1. I made committed changes to my main branch by mistake. Do I have to redo those changes on a new branch?
no

1. If not, what should I do?
checkout to a new branch then then commit changes. push up the new branch.

1. What is the difference between git add . and git commit -a?
Git add . stages all files and git commit -a stages and commits those that are already tracked.

1. What does rm do? How is it used with directories?
rm deletes/removes. rm -r directoryName/ or rm file

1. Once I've staged my changes in git, what do I have to do next?
git commit -m "message"

1. How can I override something in a css file? Give at least one example.
Add an inline style `<p style="color:black"></p>`

1. How do I link my css to my html page?
with a link tag in the head

1. What is the output of this code?
The value of x is $x

```PHP
    $x = 0;
    if($x){
        echo "The value of x is $x";
    } else {
        echo 'The value of x is $x';
    }
```

----------

1. How can I see a listing of my previous commits on my pc? `git log` @rbaia28

1. What command can I use to list all files (including hidden files) in my current directory? `ls -a` @eiman-kased

1. What command can I use to find out what directory I am in? `pwd` @WaymonBrown84

1. What is the difference between `'` and `"` in PHP? @tfrazzini13

1. What are the PHP values that equate to `FALSE`? 0, null, false, empty string @nburd90

1. What goes in a `<head></head>` tag? all the metadata for the page, such as links to the css sheet, google fonts, bootstrap etc. @margeschrec

1. Why would I use an html class property vs an id? id should apply to a single element, where class applies to a larger subset of elements without being tag specific. ie error class @CharleswithLove

1. Explain what `$_POST` is in PHP. It is an array @gc824

1. What html property is used to populate the `$_POST` array in PHP? the `name` property. @williamrockowl

1. When should I use inline styles? To override other styles @cwlainson

1. What is the order of the git workflow? @nburd90
git clone url
cd into new directory
git checkout -b name-of-branch
create and update some files
git status
git add filename(s)
git commit -m "the message that identifies what changes were made"
git push -u origin name-of-branch
create a pull request
add a reviewer to pull request
assign yourself to the pull request
once approved merge the request into main/master
git checkout main/master
git pull -p

1. What is the output of the following code?
End processing @vricci518

```PHP
$array = array();

if(!empty($array)){
    echo 'The array has '.length($array).' elements';
}
echo 'End processing';
```

1. How can I tie a pull request or commit to a specific ticket in GitHub?