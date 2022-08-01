# List of things to know
#### Creation date: 30 July 2022
#### Last updated: 30 July 2022

###### Git commands

`git pull origin main`
Before you start new work, by creating a new branch, make sure to run this command while in the "main" branch to ensure you have pulled the latest stuff

`git branch`
To check which branch you are on and to also view all branches you have

`git checkout <branch_name>`
To switch between branches

`git checkout -b <branch_name>`
To create a new branch. Usually you'll be on the "main" branch and run this command. You will create a new branch off of main

`git status`
To check the state of your branch

`git push origin <branch_name>`
Once you have committed your work and ready to push it to Github, you will run this command

`git branch -D <branch_name>`
To delete a branch from your local machine. This is usually done after your work has been merged into "main". It is best to delete these branches to avoid confusion. We will keep the branches on Github if you ever need to see one again. Ensure you are not on the branch you want to delete when deleting it

`git rebase <branch_name>`
When you have a branch that is behind main, it'll need rebasing. Navigate to this branch, run "git rebase main" and it will update your branch with the latest stuff. If there are conflicts, you will see them and they can be addressed. This will not happen all too often, but it is worth knowing

###### General process

1. Pull a fresh master
2. Create a new branch
3. Make your changes/additions/deletions
4. Commit your work
5. Push to Github
6. Create a Pull Request
7. Get it reviewed
8. Merge into "main"
9. Delete your branch from your local

###### How to  run the app
1. Install Node.js
2. Navigate to the project folder and run the following from a terminal:
    - npm init -y (to create a Node.js project)
    - npm i express (to install Express)
    - `node server.js` (to run the server)
3. Open localhost in a web browser, using the port specified in server.js e.g. http://localhost:8080/
