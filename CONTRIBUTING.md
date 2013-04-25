# How to contribute
First off, thanks for you interest in contributing. Everyone who uses this repos really appreciates it.

## Issues
### Package Managers
If you're requesting a new repository be included, please include links to
1. Search page
2. query url `domain.com/search?q={query}` (if applicable)
3. json file (if applicable)
4. logo image

## Pull Requests
### For All Workflows
If you add a new keyword workflow please make sure you update and include the following.

- [ ] Increase the version number in `update.json` inside `WORKFLOW_NAME.alfredworkflow`.
- [ ] Increase the version number in `WORKFLOW_NAME.json`.
- [ ] Include a large icon in the `WORKFLOW_NAME/icon-src/` folder that has square dimensions.
- [ ] Include a cached icon in the `WORKFLOW_NAME/icon-cache/` folder that 256x256 pixels. Alfred creates these when you insert an image into a workflow. You can get this from inside the `.alfredworkflow`
- [ ] Add the new keyword to README.md.
- [ ] Exported version of your update.

### Package Managers
- [ ] Add a screen show. Use ⌘ (command) + ⇧ (shift) + 4, press ␣ (space), then click on the Alfred window to create a clean screen shot.

