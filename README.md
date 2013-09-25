# Alfred Workflows for Developers

## Installing
1. Click the download buttons below
2. Double-click to import into Alfred 2
3. Review the workflow to add custom Hotkeys

## Updating
Run the [Alleyoop Workflow](http://www.alfredforum.com/topic/1582-alleyoop-update-alfred-workflows/) using the keyword `oop`. If you're not comfortable with Alleyoop, **star this repo** to keep up to date on new versions and additional workflows.

## Workflows
### [Package Managers](https://github.com/willfarrell/alfred-pkgman-workflow) ([Download  v1.15](https://raw.github.com/willfarrell/alfred-pkgman-workflow/master/Package%20Managers.alfredworkflow))
Quick package/plugin/component (repo) lookup of for your favourite package managers. Currently supports `Alcatraz`, `bower`, `CocoaDocs/CocoaPods`, `Composer`, `docker`, `Grunt`, `Homebrew`, `Maven`, `npm`, `pear`, `pypi`, `gems`, and `rpm`. All workflows require constant internet connection.

All repos have caching enabled to speed up common queries. These caches are refreshed after 14 days and may take longer then expected to return results during update. You can force a cache refresh by running `pkgman cachedb` to redownload the databases (applies to `alcatraz`, `grunt`, `cocoa`). Alternatively you can run `pkgman cleardb` to remove all stored cache, but this isn't recommened.

![alt text][pkgman]

### [Dash](https://github.com/willfarrell/alfred-dash-workflow) ([Download  v1.5](https://raw.github.com/willfarrell/alfred-dash-workflow/master/Dash.alfredworkflow))
[Dash](http://kapeli.com/) comes with default Alfred 2 Workflow. This is an extension to that by shortening the keyword filters for each language. Does not require online connection.

**Commands Included:** `dash {query}` (default), `html {query}`, `css {query}`, `js {query}`, `jquery {query}`, `angularjs {query}`, `bootstrap {query}`, `svg {query}`, `nodejs {query}`, `php {query}`, `redis {query}`, `mysql {query}`, `cpp {query}`, `backbone {query}`, `underscore {query}`, `sass {query}`, `compass {query}`, `wordpress {query}`, `drupal {query}`

![alt text][dash]

### [Dev Doctor](http://wemakeawesomesh.it/alfred-dev-doctor/) ([Download v1.5](https://github.com/sydlawrence/alfred-dev-doctor))
Work just like the Dash Workflow, but requires a constant internet connection. A great alternative for those who don't own Dash.

### [caniuse](https://github.com/willfarrell/alfred-caniuse-workflow) ([Download v1.0](https://raw.github.com/willfarrell/alfred-caniuse-workflow/master/caniuse.alfredworkflow))
Alfred App Workflow for caniuse.com

![alt text][caniuse]

### [StackOverflow](https://github.com/tzarskyz/Alfred-1) ([Download v1.0](https://github.com/tzarskyz/Alfred-1/blob/master/stackoverflow.alfredworkflow?raw=true))

`st {query}`

![alt text][st]

### [ssh](https://github.com/isometry/alfredworkflows/tree/master/net.isometry.alfred.ssh) ([Download v?](https://raw.github.com/isometry/alfredworkflows/master/ssh.alfredworkflow))
![alt text][ssh]

### [Jenkins](https://github.com/jeroenseegers/alfred-jenkins-workflow) ([Download  v1.0](https://github.com/jeroenseegers/alfred-jenkins-workflow/raw/master/Jenkins.alfredworkflow))

`jenkins {query}`

![alt text][jenkins]

### [Kill Process](https://github.com/nathangreenstein/alfred-process-killer) ([Download v1.2](https://github.com/nathangreenstein/alfred-process-killer/raw/master/Kill%20Process.alfredworkflow))

`kill {query}`

![alt text][kill]

### Encode/Decode ([Download  v1.1](https://raw.github.com/willfarrell/alfred-workflows/master/encode-decode.alfredworkflow))
Using the keywords `encode {query}` or `decode {query}`, will transform your query strings through *base64*, *html*, *url*, and *utf-8* encode/decode. Pressing enter will copy the encoded/decoded string to the clipboard.

![alt text][encode]

### [Colors](https://github.com/TylerEich/Alfred-Extras) ([Download  v1.2](https://github.com/TylerEich/Alfred-Extras/blob/master/Workflows/Colors.alfredworkflow))
Color convertions: `c`, `hsl`, `rgb`, `#`

### [VMWare Fusion](https://github.com/ctwise/alfred-workflows#vmware-control) ([Download v1.1](http://tedwi.se/u/d4))
@ctwise

### VirtualBox ([Download  v1.0](https://www.dropbox.com/s/51pyuuj051pydn2/VirtualBox.alfredworkflow))
@MattD

### [Beanstalk](https://github.com/Leenug/Alfred-Beanstalk) ([Download  v1.0](https://github.com/Leenug/Alfred-Beanstalk/blob/master/Beanstalk.alfredworkflow?raw=true))


### Github (0.0)
Looking for one that includes secure authentication to allow for 5000 request/hour.

## License
Pick your poison [Apache Public License](https://www.apache.org/licenses/) / [MIT](http://opensource.org/licenses/MIT) / [GNU General Public License](http://www.gnu.org/licenses/gpl.html) Copyright © 2013 will Farrell willfarrell.ca


[caniuse]: https://raw.github.com/willfarrell/alfred-caniuse-workflow/master/screenshots/caniuse.png "Sample caniuse result"
[pkgman]: ./screenshots/pkgman.png "Sample pkgman result"

[ssh]: https://raw.github.com/isometry/alfredworkflows/master/screenshots/ssh_user@local.png "Sample ssh result"

[dash]: ./screenshots/dash.png  "Sample dash result"



[st]: ./screenshots/st.png "Sample StackOverflow result"

[jenkins]: https://github.com/jeroenseegers/alfred-jenkins-workflow/raw/master/alfred-jenkins-workflow-screenshot.png "Sample jenkins result"

[kill]: https://github.com/nathangreenstein/alfred-process-killer/raw/master/screenshot1.png "Sample kill result"

[encode]: ./screenshots/encode.png  "Sample encode result"
