# Pop Quiz

## 2/18/21

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

## 2/22/21

1. How can I see a listing of my previous commits on my pc? `git log` @rbaia28

1. What command can I use to list all files (including hidden files) in my current directory? `ls -a` @eiman-kased

1. What command can I use to find out what directory I am in? `pwd` @WaymonBrown84

1. What is the difference between `'` and `"` in PHP? '' is a string literal, it won't interpret variables, "" will interpret the value of the variable if used.

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

----------

## 2/25/21

1. How can I tie a pull request or commit to a specific ticket in GitHub?
@tfrazzini13 Add the ticket number to the message or pull request comment

1. What is a CDN?
@eiman-kased - Content Delivery Network

1. What command can I use to see all local branches?
@margeschrec `git branch`

1. What command can I use to see all remote branches?
@rbaia28 `git branch -r`

1. What tag do we use to open a php block?
@gc824 `<?php`

1. What HTML attribute do we use with bootstrap to style an element?
@WaymonBrown84 class

1. What command can I use to see all changes that haven't been committed?
@nburd90 `git status`

1. What command can I use to see all hidden files in a directory?
@cwlainson `ls -a`

1. Why does bootstrap css go *before* all other css?
@vricci518 So your styling doesn't get overwritten by bootstrap

1. What kind of application do I need running to use PHP?
@CharleswithLove webserver

1. What does concatenate mean?
@williamrockowl To link two strings together

----------

## 3/4/21

1. What are `<header>`, `<main>`, and `<footer>`?
@nburd90 special div tags

1. What 2 things are needed to use bootstrap?
@rbaia28 the css and the js

1. Why do we use databases?
@cwlainson data is valuable and its a great way to store

1. What SQL command would I use to get specific information out of a table?
@vricci518 select

1. What does CRUD stand for?
@margeschrec Create Retrieve Update Delete

1. Which SQL command do I use to put information into a database?
@williamrockowl Insert

1. What does SQL stand for?
@CharleswithLove structured query language

1. How can I verify the value of a variable in PHP?
@gc824 echo it out or use `var_dump()`

1. What does `<?=` mean?
@eiman-kased shortcut for echo

1. What is the output of this code?
@WaymonBrown84 This results in an error because `$counter` grows to a value larger than the number of elements in the array. The array has 8 elements but the value of `$counter` is 16. See the output below.

```
php > $stuff = array();
php > $counter = 0;
php > while(count($stuff) < 8){
php {   $stuff[] = $counter;
php {   $counter += 2;
php { }
php > var_dump($stuff);
array(8) {
  [0]=>
  int(0)
  [1]=>
  int(2)
  [2]=>
  int(4)
  [3]=>
  int(6)
  [4]=>
  int(8)
  [5]=>
  int(10)
  [6]=>
  int(12)
  [7]=>
  int(14)
}
php > echo $counter;
16
php > 
```

```PHP
$stuff = array();
$counter = 0;
while(count($stuff) < 8){
  $stuff[] = $counter;
  $counter += 2;
}
echo $stuff[$counter];
```

----------

## 3/10/21

1. How do I create a variable in JS?
@nburd90

1. What is the difference between a while loop and a for loop?
@margeschrec a for loop is used when we already know the number of iterations, while loop is used for an unknown number of iterations

1. How do I get my js file to run on my webpage?
@vricci518 use the script tag, it can be placed within the head of the html file. For Bootstrap it recomended to put is just above the /body tag to the page can load first.

1. What does the `%` symbol mean?
@rbaia28 called a modulus, shows the remainder

1. What property can I use to find out how many letters are in a word in js?
@WaymonBrown84

1. What is a conditional?
@cwlainson

1. What is the difference between `document.write()` and `console.log()` in js?
@gc824

1. What does the `++` operator do?
@eiman-kased

1. Correct this code: `console.log('There's something wrong here!')`
@CharleswithLove


1. What is the advantage of using a front end programming language?
@williamrockowl
