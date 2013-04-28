# How to contribute
First off, thanks for you interest in contributing. Everyone who uses this repos really appreciates it.

## Issues
### Suggest a Workflow
Found or developed a workflow you think other developers will like? Provide a link to it's github page or Submit a Pull Request with a modified README.md.

### Package Managers
If you're requesting a new repository be included, please include links to:

1. Search page
2. query url `domain.com/search?q={query}` (if applicable)
3. json file (if applicable)
4. logo image

## Pull Requests
Good pull requests - patches, improvements, new features - are a fantastic help.
They should remain focused in scope and avoid containing unrelated commits. If
your contribution involves a significant amount of work or substantial changes
to any part of the project, please open an issue to discuss it first.

Make sure to adhere to the coding conventions used throughout a project
(indentation, accurate comments, etc.). Please update any documentation that is
relevant to the change you're making.

### For All Workflows
If you add a new keyword workflow please make sure you update and include the following.

- Increase the version number in `update.json` inside `WORKFLOW_NAME.alfredworkflow`.
- Increase the version number in `WORKFLOW_NAME.json`.
- Include a large icon in the `WORKFLOW_NAME/icon-src/` folder that has square dimensions.
- Include a cached icon in the `WORKFLOW_NAME/icon-cache/` folder that 256x256 pixels. Alfred creates these when you insert an image into a workflow. You can get this from inside the `.alfredworkflow`
- Add the new keyword to README.md.
- Exported version of your update.

### Package Managers
- Add a screen shot. Use ⌘ (command) + ⇧ (shift) + 4, press ␣ (space), then click on the Alfred window to create a clean screen shot.

## Pull Request Process
Please follow this process; it's the best way to get your work included in the
project:

1. [Fork](http://help.github.com/fork-a-repo/) the project, clone your fork,
   and configure the remotes:

   ```bash
   # Clones your fork of the repo into the current directory in terminal
   git clone https://github.com/<your-username>/<this-repo-name>.git
   # Navigate to the newly cloned directory
   cd server-configs
   # Assigns the original repo to a remote called "upstream"
   git remote add upstream https://github.com/<this-username>/<this-repo-name>.git
   ```

2. If you cloned a while ago, get the latest changes from upstream:

   ```bash
   git checkout master
   git pull upstream master
   ```

3. Create a new topic branch to contain your feature, change, or fix:

   ```bash
   git checkout -b <topic-branch-name>
   ```

4. Commit your changes in logical chunks. Please adhere to these [git commit
   message guidelines](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html)
   or your pull request is unlikely be merged into the main project. Use git's
   [interactive rebase](https://help.github.com/articles/interactive-rebase)
   feature to tidy up your commits before making them public.

5. Locally merge (or rebase) the upstream development branch into your topic
   branch:

   ```bash
   git pull [--rebase] upstream master
   ```

6. Push your topic branch up to your fork:

   ```bash
   git push origin <topic-branch-name>
   ```

7. [Open a Pull Request](https://help.github.com/articles/using-pull-requests)
   with a clear title and description.

