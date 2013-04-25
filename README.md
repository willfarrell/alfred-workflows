# Alfred Workflows for Developers

***

## Installing
1. Click the download buttons below
2. Double-click to import into Alfred 2
3. Review the workflow to add custom Hotkeys

## Updating
Run the [Alleyoop Workflow](http://www.alfredforum.com/topic/1582-alleyoop-update-alfred-workflows/) using the keyword `oop`. If you're not comfortable with Alleyoop, **star this repo** to keep up to date on new versions and additional workflows.

## Contributing
See [CONTRIBUTING.md](https://github.com/willfarrell/alfred-workflows/blob/master/CONTRIBUTING.md) for guidelines.

## Workflows
### Package Managers (1.5) [[Download](https://raw.github.com/willfarrell/alfred-workflows/master/Package%20Managers.alfredworkflow)]
Quick package/plugin/component (repo) lookup of for your favourite package managers. Currently supports `Alcatraz`, `bower`, `CocoaDocs/CocoaPods`, `Composer`, `Grunt`, `Homebrew`, `Maven`, `npm`, `pear`, and `rpm`. All workflows require constant internet connection. 

 Some repos cache their database (`alcatraz`, `grunt`, `cocoa`), these databases are refreshed  after 14 days and may take longer then expected to return results during update. You can force a database refresh by running `pkgman cachedb` to redownload the databases.

**js, css, html:** `bower {query}` 

![alt text][bower]

**node.js:** `npm {query}`

![alt text][npm]

**node.js task runner:** `grunt {query}`

![alt text][grunt]

**XCode:** `alcatraz {query}`, `cocoa {query}`

CocoaPods can be upgraded to CocoaDocs by changing `$apple_docs` to true in the script.

![alt text][alcatraz]
![alt text][cocoa]

**PHP:** `composer {query}`, `pear {query}`

![alt text][composer]
![alt text][pear]

**Java** `maven {query}`

![alt text][maven]

**Mac OS X:** `brew {query}` (aka *homebrew*)

![alt text][brew]

**Linux:** `rpm {query}`

![alt text][rpm]

### Dash (1.2) [[Download](https://raw.github.com/willfarrell/alfred-workflows/master/Dash.alfredworkflow)]
[Dash](http://kapeli.com/) comes with default Alfred 2 Workflow. This is an extension to that by shortening the keyword filters for each language. Does not require online connection.

**Commands Included:** `dash {query}` (default), `html {query}`, `css {query}`, `js {query}`, `jquery {query}`, `angularjs {query}`, `bootstrap {query}`, `svg {query}`, `nodejs {query}`, `php {query}`, `redis {query}`, `mysql {query}`, `cpp {query}`

![alt text][dash]

### [Dev Doctor](http://wemakeawesomesh.it/alfred-dev-doctor/) (1.5) [[Download](https://github.com/sydlawrence/alfred-dev-doctor)]
Work just like the Dash Workflow, but requires a constant internet connection. A great alternative for those who don't own Dash.

### [StackOverflow](https://github.com/tzarskyz/Alfred-1) (1.1) [[Download](https://raw.github.com/willfarrell/alfred-workflows/master/StackOverflow.alfredworkflow)]

`st {query}`

![alt text][st]

### [Jenkins](https://github.com/jeroenseegers/alfred-jenkins-workflow) (1.0) [[Download](https://github.com/jeroenseegers/alfred-jenkins-workflow/raw/master/Jenkins.alfredworkflow)] 

`jenkins {query}`

![alt text][jenkins]

### [Kill Process](https://github.com/nathangreenstein/alfred-process-killer) (1.0)  [[Download](https://github.com/nathangreenstein/alfred-process-killer/raw/master/Kill%20Process.alfredworkflow)] 

`kill {query}`

![alt text][kill]

### Encode/Decode (1.1) [[Download](https://raw.github.com/willfarrell/alfred-workflows/master/encode-decode.alfredworkflow)]
Using the keywords `encode {query}` or `decode {query}`, will transform your query strings through *base64*, *html*, *url*, and *utf-8* encode/decode. Pressing enter will copy the encoded/decoded string to the clipboard.

![alt text][encode]

### Github (0.0)
Looking for one that includes secure authentication to allow for 5000 request/hour.

## License
Pick your poison [Apache Public License 2.0](http://www.apache.org/licenses/LICENSE-2.0.html) / [MIT](http://opensource.org/licenses/MIT) / [GNU General Public License v2.0](http://www.gnu.org/licenses/gpl-2.0.html).



[alcatraz]: ./Screenshots/alcatraz.png  "Sample alcatraz result"
[bower]: ./Screenshots/bower.png  "Sample bower result"
[brew]: ./Screenshots/brew.png  "Sample brew result"
[cocoa]: ./Screenshots/cocoa.png  "Sample cocoa result"
[composer]: ./Screenshots/composer.png  "Sample composer result"
[grunt]: ./Screenshots/grunt.png "Sample grunt result"
[maven]: ./Screenshots/maven.png "Sample maven result"
[npm]: ./Screenshots/npm.png "Sample npm result"
[pear]: ./Screenshots/pear.png "Sample pear result"
[rpm]: ./Screenshots/rpm.png "Sample rpm result"

[dash]: ./Screenshots/dash.png  "Sample dash result"

[st]: ./Screenshots/st.png "Sample StackOverflow result"

[jenkins]: https://github.com/jeroenseegers/alfred-jenkins-workflow/raw/master/alfred-jenkins-workflow-screenshot.png "Sample jenkins result"

[kill]: https://github.com/nathangreenstein/alfred-process-killer/raw/master/screenshot.png "Sample kill result"

[encode]: ./Screenshots/encode.png  "Sample encode result"