# Alfred Workflows for Developers

## Installing
1. Click the download buttons below
2. Double-click to import into Alfred 2
3. Review the workflow to add custom Hotkeys

## Updating
Run the [Alleyoop Workflow](http://www.alfredforum.com/topic/1582-alleyoop-update-alfred-workflows/) using the keyword `oop` o r [Monkey Patch](https://github.com/BenziAhamed/monkeypatch-alfred) using the keyword `mp`. If you're not comfortable with Alleyoop, **star this repo** to keep up to date on new versions and additional workflows.

## Workflows
### [Github](https://github.com/willfarrell/alfred-github-workflow) ([Download](https://raw.github.com/willfarrell/alfred-github-workflow/master/Github.alfredworkflow))
by [@willfarrell](https://github.com/willfarrell)

Searching Github for gists, repos, user repos, or repos starred by a user. 5000 requests per hour supported.
![alt text][github]

### [Package Managers](https://github.com/willfarrell/alfred-pkgman-workflow) ([Download](https://raw.github.com/willfarrell/alfred-pkgman-workflow/master/Package%20Managers.alfredworkflow))
by [@willfarrell](https://github.com/willfarrell)

Quick package/plugin/component (repo) lookup of for your favourite package managers. Currently supports `Alcatraz`, `bower`, `CocoaDocs/CocoaPods`, `Composer`, `docker`, `Grunt`, `Homebrew`, `Maven`, `npm`, `pear`, `pypi`, `gems`, and `rpm`. All workflows require constant internet connection.

All repos have caching enabled to speed up common queries. These caches are refreshed after 14 days and may take longer then expected to return results during update. You can force a cache refresh by running `pkgman cachedb` to redownload the databases (applies to `alcatraz`, `grunt`, `cocoa`). Alternatively you can run `pkgman cleardb` to remove all stored cache, but this isn't recommened.

![alt text][pkgman]

### [Dash](https://github.com/willfarrell/alfred-dash-workflow) ([Download](https://raw.github.com/willfarrell/alfred-dash-workflow/master/Dash.alfredworkflow))
by [@willfarrell](https://github.com/willfarrell)

[Dash](http://kapeli.com/) comes with default Alfred 2 Workflow. This is an extension to that by shortening the keyword filters for each language. Does not require online connection.

**Commands Included:** `dash {query}` (default), `html {query}`, `css {query}`, `js {query}`, `jquery {query}`, `angularjs {query}`, `bootstrap {query}`, `svg {query}`, `nodejs {query}`, `php {query}`, `redis {query}`, `mysql {query}`, `cpp {query}`, `backbone {query}`, `underscore {query}`, `sass {query}`, `compass {query}`, `wordpress {query}`, `drupal {query}`

![alt text][dash]

### [caniuse](https://github.com/willfarrell/alfred-caniuse-workflow) ([Download](https://raw.github.com/willfarrell/alfred-caniuse-workflow/master/caniuse.alfredworkflow))
by [@willfarrell](https://github.com/willfarrell)

Alfred App Workflow for caniuse.com

![alt text][caniuse]

### [CDN](https://github.com/willfarrell/alfred-cdn-workflow) ([Download](https://raw.github.com/willfarrell/alfred-cdn-workflow/master/CDN.alfredworkflow))
by [@willfarrell](https://github.com/willfarrell)

Check which CDNs a package is hosted on.

![alt text][cdn]

### [localhost](https://github.com/willfarrell/alfred-localhost-workflow) ([Download](https://raw.github.com/willfarrell/alfred-localhost-workflow/master/localhost.alfredworkflow))
by [@willfarrell](https://github.com/willfarrell)

Toggle Localhost Services. IN DEV

![alt text][localhost]

### [StackOverflow](https://github.com/tzarskyz/Alfred-1) ([Download](https://github.com/tzarskyz/Alfred-1/blob/master/stackoverflow.alfredworkflow?raw=true))
by [@tzarskyz](https://github.com/tzarskyz)

`st {query}`

![alt text][st]

### [ssh](https://github.com/isometry/alfredworkflows/tree/master/net.isometry.alfred.ssh) ([Download](https://raw.github.com/isometry/alfredworkflows/master/ssh.alfredworkflow))
by [@isometry](https://github.com/isometry)

![alt text][ssh]

### [Jenkins](https://github.com/jeroenseegers/alfred-jenkins-workflow) ([Download](https://github.com/jeroenseegers/alfred-jenkins-workflow/raw/master/Jenkins.alfredworkflow))
by [@jeroenseegers](https://github.com/jeroenseegers)

`jenkins {query}`

![alt text][jenkins]

### [Kill Process](https://github.com/nathangreenstein/alfred-process-killer) ([Download](https://github.com/nathangreenstein/alfred-process-killer/raw/master/Kill%20Process.alfredworkflow))
by [@nathangreenstein](https://github.com/nathangreenstein)

`kill {query}`

![alt text][kill]

### [FontAwesome](https://github.com/ruedap/alfred2-font-awesome-workflow) ([Download](https://raw.github.com/ruedap/alfred2-font-awesome-workflow/master/Font%20Awesome.alfredworkflow))
by [@ruedap](https://github.com/ruedap)

You can incremental search for Font Awesome Icon Fonts and paste it to front most app.

![alt text][fontawesome]

### [Encode / Decode](https://github.com/willfarrell/alfred-encode-decode-workflow) ([Download](https://raw.github.com/willfarrell/alfred-encode-decode-workflow/master/encode-decode.alfredworkflow))
by [@willfarrell](https://github.com/willfarrell)

Using the keywords `encode {query}` or `decode {query}`, will transform your query strings through *base64*, *html*, *url*, and *utf-8* encode/decode. Pressing enter will copy the encoded/decoded string to the clipboard.

![alt text][encode]

### [Colors](https://github.com/TylerEich/Alfred-Extras) ([Download](https://github.com/TylerEich/Alfred-Extras/blob/master/Workflows/Colors.alfredworkflow))
by [@TylerEich](https://github.com/TylerEich)

Color convertions: `c`, `hsl`, `rgb`, `#`

### [VMWare Fusion](https://github.com/ctwise/alfred-workflows#vmware-control) ([Download](http://tedwi.se/u/d4))
by [@ctwiseby](https://github.com/ctwise)

### VirtualBox ([Download](https://www.dropbox.com/s/51pyuuj051pydn2/VirtualBox.alfredworkflow))
by [@MattD](https://github.com/MattD)

### [Beanstalk](https://github.com/Leenug/Alfred-Beanstalk) ([Download](https://github.com/Leenug/Alfred-Beanstalk/blob/master/Beanstalk.alfredworkflow?raw=true))
by [@Leenug](https://github.com/Leenug)

[caniuse]: https://raw.github.com/willfarrell/alfred-caniuse-workflow/master/screenshots/caniuse-browser.png "Sample result"
[cdn]: https://raw.github.com/willfarrell/alfred-cdn-workflow/master/screenshots/cloudflare.png "Sample result"
[dash]: https://raw.github.com/willfarrell/alfred-dash-workflow/master/screenshots/dash.png  "Sample result"
[encode]: https://raw.github.com/willfarrell/alfred-encode-decode-workflow/master/screenshots/encode.png  "Sample result"
[fontawesome]: http://gifzo.net/ZqCN4wKUcq.gif "Sample result"
[github]: https://raw.github.com/willfarrell/alfred-github-workflow/master/screenshots/my.png "Sample result"
[jenkins]: https://github.com/jeroenseegers/alfred-jenkins-workflow/raw/master/alfred-jenkins-workflow-screenshot.png "Sample jenkins result"
[localhost]: https://raw.github.com/willfarrell/alfred-localhost-workflow/master/screenshots/apache.png "Sample result"
[kill]: https://github.com/nathangreenstein/alfred-process-killer/raw/master/screenshot1.png "Sample kill result"
[pkgman]: https://raw.github.com/willfarrell/alfred-pkgman-workflow/master/screenshots/npm.png "Sample result"
[ssh]: https://raw.github.com/isometry/alfredworkflows/master/screenshots/ssh_user@local.png "Sample ssh result"
[st]: https://github-camo.global.ssl.fastly.net/a5d8023b27bf15d503db5768220b6e779465ecd3/687474703a2f2f3768326f2e636f6d2f6173736574732f696d672f736f616c667265642f736f616c66726564322e706e67 "Sample StackOverflow result"




