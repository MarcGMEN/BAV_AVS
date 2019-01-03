 var MSIE4 = ((navigator.appName=="Microsoft Internet Explorer") && ( navigator.appVersion.substring(0,1)=="4"));

 if (MSIE4) {
 var fso = new ActiveXObject("Scripting.FileSystemObject");
 compatible = "Internet Explorer 4";
 }

 /**
	 * renvoi true si le navigator est Microsoft Internet Explorer
	 * 
	 * @return {boolean}
	 */
 function isMSIE4() {
 return MSIE4;
 }

 var mozex_default_tmpdir = "/tmp"; /* unix */
 var mozex_dir_separator = '/'; /* unix */
 var mozex_os = 'unix'; /* unix */
 if (window.navigator.platform.toLowerCase().indexOf("win") != -1) {
	 mozex_default_tmpdir = "C:\\windows\\temp"; /* windows */
	 mozex_dir_separator = '\\'; /* windows */
	 mozex_os = 'win'; /* windows */
 }

 /**
	 * renvoi uri de la page courante
	 * 
	 * @return {string}
	 */
 function basename(uri) {
 uri = uri.substring(1, uri.lastIndexOf('/'));
 return uri;
 }
 /**
	 * renvoi le chemin locale de la fpage courante
	 * 
	 * @return {string}
	 */
 function getPath() {
 var currentDir;
 var url = unescape(self.location.pathname);
 if (isMSIE4()) {
 currentDir = fso.GetParentFolderName(url).substr(1);
 } else {
 currentDir = (basename(url));
 }
 return currentDir;
 }
 /**
	 * Copie d'un fichier
	 * 
	 * @param {string}
	 *            srcFile Chemin du fichier source (ex: C:\image.jpg)
	 * @param {string}
	 *            dstFile Chemin du fichier destination (ex: C:\image2.jpg),
	 *            écraser s'il existe
	 */
 function copyFile(srcFile,dstFile,overwrite) {
 if (isMSIE4()) {
 fso.CopyFile(srcFile,dstFile,overwrite);
 } else {
 copyFolderMozilla(srcFile,dstFile,overwrite);
 }
 }
 /**
	 * Sauvergarde d'un texte dans un fichier
	 * 
	 * @param {string}
	 *            content Contenus à sauver
	 * @param {string}
	 *            filename Chemin du fichier destination (ex: C:\texte.txt),
	 *            écraser s'il existe
	 */
 function saveToFile(content,filename) {
 if (isMSIE4()) {
 saveToFileMSIE(content,filename);
 } else {
 saveToFileMozilla(content,filename);
 }
 }
 /**
	 * Chargement du contenus d'un fichier dans une chaine
	 * 
	 * @param {string}
	 *            filename Chemin du fichier à cahrger (ex: C:\texte.txt)
	 * @return {string} Contenus du fichier
	 */
 function loadFromFile(filename) {
 var str;
 if (isMSIE4()) {
 str = loadFromFileMSIE(filename);
 } else {
 str = loadFromFileMozilla(filename);
 }
 return str;
 }
 /**
	 * Sauvergarde, sous IE, d'un texte dans un fichier
	 * 
	 * @param {string}
	 *            content Contenus à sauver
	 * @param {string}
	 *            filename Chemin du fichier destination (ex: C:\texte.txt),
	 *            écraser s'il existe
	 */
 function saveToFileMSIE(content,filename) {
 try {
 var ts = fso.CreateTextFile(filename);
 ts.Write(content);
 ts.Close();
 } catch(e) {
 document.write("Exception in saveToFileMSIE");
 }
 }
 /**
	 * Chargement, sous IE, du contenus d'un fichier dans une chaine
	 * 
	 * @param {string}
	 *            filename Chemin du fichier à cahrger (ex: C:\texte.txt)
	 * @return {string} Contenus du fichier
	 */
 function loadFromFileMSIE(filename) {
 try {
 var ts;
 var str = '';
 if (fso.FileExists(filename)) {
 ts = fso.OpenTextFile(filename,1,false);
 str = ts.ReadAll();
 ts.Close();
 }
 return (str);
 } catch(e) {
 document.write("Exception in loadFromFileMSIE");
 }
 }
 /**
	 * Sauvergarde, sous Mozilla, d'un texte dans un fichier
	 * 
	 * @param {string}
	 *            content Contenus à sauver
	 * @param {string}
	 *            filename Chemin du fichier destination (ex: C:\texte.txt),
	 *            écraser s'il existe
	 */
 function saveToFileMozilla(content,filename) {
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to save file was denied.");
 }
 var file = Components.classes["@mozilla.org/file/local;1"]
 .createInstance(Components.interfaces.nsILocalFile);
 filename = filename.replace(/\//gi,mozex_dir_separator);
 file.initWithPath( filename );
 if ( file.exists() == false ) {
 file.create( Components.interfaces.nsIFile.NORMAL_FILE_TYPE, 420 );
 }
 var outputStream = Components.classes["@mozilla.org/network/file-output-stream;1"]
 .createInstance( Components.interfaces.nsIFileOutputStream );
 /*
	 * Open flags #define PR_RDONLY 0x01 #define PR_WRONLY 0x02 #define PR_RDWR
	 * 0x04 #define PR_CREATE_FILE 0x08 #define PR_APPEND 0x10 #define
	 * PR_TRUNCATE 0x20 #define PR_SYNC 0x40 #define PR_EXCL 0x80
	 */
 /*
	 * * File modes .... * * CAVEAT: 'mode' is currently only applicable on UNIX
	 * platforms. * The 'mode' argument may be ignored by PR_Open on other
	 * platforms. * * 00400 Read by owner. * 00200 Write by owner. * 00100
	 * Execute (search if a directory) by owner. * 00040 Read by group. * 00020
	 * Write by group. * 00010 Execute by group. * 00004 Read by others. * 00002
	 * Write by others * 00001 Execute by others. *
	 */
 outputStream.init( file, 0x04 | 0x08 | 0x20, 420, 0 );
 var result = outputStream.write( content, content.length );
 outputStream.close();
 }
 /**
	 * Chargement, sous Mozilla, du contenus d'un fichier dans une chaine
	 * 
	 * @param {string}
	 *            filename Chemin du fichier à cahrger (ex: C:\texte.txt)
	 * @return {string} Contenus du fichier
	 */
 function loadFromFileMozilla(filename) {
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to read file was denied.");
 }

 var file = Components.classes["@mozilla.org/file/local;1"]
 .createInstance(Components.interfaces.nsILocalFile);

 filename = filename.replace(/\//gi,mozex_dir_separator);
 file.initWithPath( filename );
 if ( file.exists() == true ) {
 var is = Components.classes["@mozilla.org/network/file-input-stream;1"]
 .createInstance( Components.interfaces.nsIFileInputStream );
 is.init( file,0x01, 00004, null);
 var sis = Components.classes["@mozilla.org/scriptableinputstream;1"]
 .createInstance( Components.interfaces.nsIScriptableInputStream );
 sis.init( is );
 return sis.read( sis.available() );
 } else {
 return '';
 }
 }
 /**
	 * Copie, sous Mozilla, d'un fichier
	 * 
	 * @param {string}
	 *            srcFile Chemin du fichier source (ex: C:\image.jpg)
	 * @param {string}
	 *            dstFile Chemin du fichier destination (ex: C:\image2.jpg),
	 *            écraser s'il existe
	 */

 function copyFileMozilla(srcFile, dstFile) {
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to read file was denied.");
 }

 var ios = Components.classes["@mozilla.org/network/io-service;1"]
 .getService(Components.interfaces.nsIIOService);
 var pngFile = Components.classes["@mozilla.org/file/local;1"]
 .createInstance(Components.interfaces.nsILocalFile);
 srcFile = srcFile.replace(/\//gi,mozex_dir_separator);
 pngFile.initWithPath(srcFile);
 var istream = Components.classes["@mozilla.org/network/file-input-stream;1"]
 .createInstance(Components.interfaces.nsIFileInputStream);
 istream.init(pngFile, -1, -1, false);
 var bstream = Components.classes["@mozilla.org/binaryinputstream;1"]
 .createInstance(Components.interfaces.nsIBinaryInputStream);
 bstream.setInputStream(istream);
 var bytes = bstream.readBytes(bstream.available());

 // pngBinary already exists
 var aFile = Components.classes["@mozilla.org/file/local;1"]
 .createInstance(Components.interfaces.nsILocalFile);
 dstFile = dstFile.replace(/\//gi,mozex_dir_separator);
 aFile.initWithPath( dstFile );
 aFile.createUnique( Components.interfaces.nsIFile.NORMAL_FILE_TYPE, 600);
 var stream = Components.classes["@mozilla.org/network/safe-file-output-stream;1"]
 .createInstance(Components.interfaces.nsIFileOutputStream);
 stream.init(aFile, 0x04 | 0x08 | 0x20, 0600, 0); // write, create, truncate
 stream.write(bytes, bytes.length);
 if (stream instanceof Components.interfaces.nsISafeOutputStream) {
 stream.finish();
 } else {
 stream.close();
 }

 return bytes;
 }

 function copyFolderMozilla(sourceFolder,destFolder,overwrite)
 {
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to read file was denied.");
 }
 var destParentFolder = getParentFolder(destFolder);
 var destFolderName = getFolderName(destFolder);

 sourceFolder = sourceFolder.replace(/\//gi,mozex_dir_separator);
 destFolder = destFolder.replace(/\//gi,mozex_dir_separator);
 destParentFolder = destParentFolder.replace(/\//gi,mozex_dir_separator);
 destFolderName = destFolderName.replace(/\//gi,mozex_dir_separator);

 // récupérer un composant pour le fichier à copier
 var aFile = Components.classes["@mozilla.org/file/local;1"]
 .createInstance(Components.interfaces.nsILocalFile);
 if (!aFile) return false;

 // récupérer un composant pour le répertoire où la copie va s'effectuer.
 var aDir = Components.classes["@mozilla.org/file/local;1"]
 .createInstance(Components.interfaces.nsILocalFile);
 if (!aDir) return false;

 // ensuite, on initialise les chemins
 aFile.initWithPath(sourceFolder);
 aDir.initWithPath(destParentFolder);

 // Au final, on copie le dossier en le renommant
 if( !fileExists(destFolder) || overwrite ) {
 // S'il n'existe pas, ou si on peut l'écraser on le copie
 aFile.copyTo(aDir,destFolderName);
 }

 }


 // ------------------------------------------------------------------------------
 function getFileBrowser( dirName ) {
 if (MSIE4) {
 return getFileBrowserMSIE( dirName );
 } else {
 return getFileBrowserMozilla( dirName );
 }
 }

 // ------------------------------------------------------------------------------
 function getFileBrowserMSIE( dirName ) {
 var result = "";
 var inp = document.createElement("input");
 inp.type="file";
 inp.value=dirName; // Ne marche pas : pas trouvé de solution !!!
 inp.id = 'hiddenfile';
 inp.name = 'fileSelect';
 inp.style.visibility='hidden';
 document.body.appendChild(inp);
 inp.click();
 result = inp.value;
 document.body.removeChild(inp);
 inp = null;
 return result;
 }

 // ------------------------------------------------------------------------------
 function getFileBrowserMozilla( dirName ) {
 var result = "";
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to access file was denied.");
 }
 var nsIFilePicker = Components.interfaces.nsIFilePicker;
 var fp = Components.classes["@mozilla.org/filepicker;1"].createInstance(nsIFilePicker);

 var dir = Components.classes["@mozilla.org/file/local;1"].createInstance(Components.interfaces.nsILocalFile);
 dirName = dirName.replace(/\//gi,mozex_dir_separator);
 dir.initWithPath( dirName );
 fp.displayDirectory = dir;
 fp.init(window, "Sélectionnez un fichier", nsIFilePicker.modeOpen);
 // fp.appendFilter("Fichiers Images","*.jpg; *.jpeg");
 fp.appendFilters(nsIFilePicker.filterImages);
 var res = fp.show();
 if (res == nsIFilePicker.returnOK){
 result = fp.file.path;
 }
 return result;
 }

 // ------------------------------------------------------------------------------
 function deleteFile( filename ) {
 if (MSIE4) {
 return deleteFileMSIE( filename );
 } else {
 return deleteFileMozilla( filename );
 }
 }

 function deleteFolder( filename ) {
 if (MSIE4) {
 return deleteFolderMSIE( filename );
 } else {
 return deleteFolderMozilla( filename );
 }
 }
 // ------------------------------------------------------------------------------
 function deleteFileMSIE( filename ) {
 var result = false;
 try {
 if (fso.FileExists(filename)) {
 fso.DeleteFile(filename);
 result = true;
 }
 } catch(e) {
 document.write("Exception in deleteFileMSIE");
 }
 return result;
 }

 function deleteFolderMSIE( filename ) {
 var result = false;
 try {
 if (fso.FolderExists(filename)) {
 fso.DeleteFolder(filename);
 result = true;
 }
 } catch(e) {
 document.write("Exception in deleteFolderMSIE");
 }
 return result;
 }

 function deleteFolderMozilla( filename ) {
 var result = false;
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to access file was denied.");
 }
 var aFile = Components.classes["@mozilla.org/file/local;1"].createInstance();
 if (aFile instanceof Components.interfaces.nsILocalFile){
 filename = filename.replace(/\//gi,mozex_dir_separator);
 aFile.initWithPath( filename );
 if(!folderExists(filename)) return false;
 aFile.remove( true );
 result = true;
 }
 return result;
 }
 // ------------------------------------------------------------------------------
 function deleteFileMozilla( filename ) {
 var result = false;
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to access file was denied.");
 }
 var aFile = Components.classes["@mozilla.org/file/local;1"].createInstance();
 if (aFile instanceof Components.interfaces.nsILocalFile){
 filename = filename.replace(/\//gi,mozex_dir_separator);
 aFile.initWithPath( filename );
 if(!fileExists(filename)) return false;
 aFile.remove( false );
 result = true;
 }
 return result;
 }

 // ------------------------------------------------------------------------------
 function getFiles( dirname ) {
 if (MSIE4) {
 return getFilesMSIE( dirname );
 } else {
 return getFilesMozilla( dirname );
 }
 }

 // ------------------------------------------------------------------------------
 function getFilesMSIE( dirname )
 {
 var result = [];
 try
 {
 var idx=0
 var parentFolder = fso.GetFolder(dirname);
 var enumFiles = new Enumerator(parentFolder.files);

 for (; !enumFiles.atEnd(); enumFiles.moveNext())
 {
 var fileItem = enumFiles.item();
 result.push( fileItem.name );
 }
 return result;
 }
 catch (_err)
 {
 alert ("Failed to Populate File List:\n");
 return null;
 }
 }

 // ------------------------------------------------------------------------------
 function getFilesMozilla( dirname )
 {
 var result = [];
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to access file was denied.");
 }
 var dir = Components.classes["@mozilla.org/file/local;1"].createInstance(Components.interfaces.nsILocalFile);
 dirname = dirname.replace(/\//gi,mozex_dir_separator);
 dir.initWithPath( dirname );
 alert(dirname);
 var entries = dir.directoryEntries;
 while(entries.hasMoreElements())
 {
 var entry = entries.getNext();
 entry.QueryInterface(Components.interfaces.nsIFile);
 result.push(entry.path);
 }
 return result;
 }

 // ------------------------------------------------------------------------------
 function fileExists( filename ) {
 if (MSIE4) {
 return fso.FileExists(filename);
 } else {
 return fileExistsMozilla( filename );
 }
 }

 function folderExists( foldername ) {
 if (MSIE4) {
 return fso.FolderExists(foldername);
 } else {
 return folderExistsMozilla( foldername );
 }
 }
 function folderExistsMozilla( foldername ) {
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to save file was denied.");
 }
 var folder = Components.classes["@mozilla.org/file/local;1"]
 .createInstance(Components.interfaces.nsILocalFile);
 foldername = foldername.replace(/\//gi,mozex_dir_separator);
 folder.initWithPath( foldername );

 if(folder.exists()) return true;
 else return false;
 }
 // ------------------------------------------------------------------------------
 function fileExistsMozilla(filename) {
 var result = false;
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to read file was denied.");
 }

 var file = Components.classes["@mozilla.org/file/local;1"]
 .createInstance(Components.interfaces.nsILocalFile);
 filename = filename.replace(/\//gi,mozex_dir_separator);
 file.initWithPath( filename );
 result = file.exists();
 return result;
 }

 function createFolder( directoryname ) {
 if (MSIE4) {
 fso.CreateFolder(directoryname);
 } else {
 createFolderMozilla( directoryname );
 }
 }
 function createFolderMozilla(directoryname) {
 try {
 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
 } catch (e) {
 alert("Permission to save file was denied.");
 }
 var directory = Components.classes["@mozilla.org/file/local;1"]
 .createInstance(Components.interfaces.nsILocalFile);
 directoryname = directoryname.replace(/\//gi,mozex_dir_separator);
 directory.initWithPath( directoryname );

 if( !directory.exists() || !directory.isDirectory() ) { // S'il n'existe
															// pas, le créer
 directory.create(Components.interfaces.nsIFile.DIRECTORY_TYPE, 0664);
 }
 }
 function relativeToAbsolute(path){
 return getPath() +"/"+ path;
 }
 function absoluteToRelative(path,homeFolder){
 var resultat = path.search(new RegExp("(.*)(/"+homeFolder+"/)(.*)","gi"));
 if(resultat != -1) return RegExp.$3;
 else return null;
 }

 function getFilePath(filePath) {
 var resultat = filePath.search(new RegExp(/(.*)\/((.*)\.(....?))/gi));
 if(resultat != -1) return RegExp.$1;
 else return filePath;
 }
 function getFileString(filePath) {
 var resultat = filePath.search(new RegExp(/(.*)\/((.*)\.(....?))/gi));
 if(resultat != -1) return RegExp.$2;
 else return filePath;
 }
 function getFileName(filePath) {
 var resultat = filePath.search(new RegExp(/(.*)\/((.*)\.(....?))/gi));
 if(resultat != -1) return RegExp.$3;
 else return filePath;
 }

 function getFileExtension(filePath) {
 var resultat = filePath.search(new RegExp(/(.*)\/((.*)\.(....?))/gi));
 if(resultat != -1) return RegExp.$4;
 else return null;
 }

 function copyFolder(folderSrc,folderDest,overwrite){
 if (MSIE4) {
 fso.CopyFolder(folderSrc,folderDest,overwrite);
 } else {
 copyFolderMozilla( folderSrc,folderDest,overwrite );
 }

 }

 function getParentFolder(path) {
 var resultat = path.search(new RegExp(/(.*)\/([^\/]*)/gi));
 if(resultat != -1) return RegExp.$1;
 else return path;
 }
 function getFolderName(path) {
 var resultat = path.search(new RegExp(/(.*)\/([^\/]*)/gi));
 if(resultat != -1) return RegExp.$2;
 else return path;
 }

 var nn = !!document.layers;
 var ie = !!document.all;
 /** reagarde si XPCOM est supporté */
 var mozilla = !!window.Components;
 var pageChargee = false;
 window.onload = function()
 {
 window.clipboard = new Clipboard();
 pageChargee = true;
 }
 /** Focntion qui permet d'attendre que la page se charge */
 function waitForLoad(_function) {
 if (pageChargee){
 _function
 } else {
 setTimeout('waitForLoad()', 100);
 }
 }


 /**
	 * Créer une nouvelle instance de Clipboard compatible Netscape, IE et
	 * Mozilla
	 * 
	 * @class Permet de lire et d'écrire du texte dans le presse papier du
	 *        système
	 * @return {Clipboard} Retourne un objet de type Clipboard
	 * @type {Object}
	 * @constructor
	 */
 function Clipboard()
 {
 if ( nn )
 {
 netscape.security.PrivilegeManager.enablePrivilege( 'UniversalSystemClipboardAccess' );
 var tmp = new java.awt.Frame();
 this.clipboard = fr.getToolkit().getSystemClipboard();
 }
 else if ( ie )
 {
 this.clipboard = document.createElement( 'INPUT' );
 with ( this.clipboard.style )
 {
 position = 'absolute';
 left = '0px';
 top = '0px';
 visibility = 'hidden';
 }
 document.body.appendChild( this.clipboard );
 }
 else if ( mozilla )
 {
 netscape.security.PrivilegeManager.enablePrivilege( 'UniversalXPConnect' );
 this.clipboardid = Components.interfaces.nsIClipboard;
 this.clipboard = Components.classes['@mozilla.org/widget/clipboard;1'].getService( this.clipboardid );
 this.clipboardstring = Components.classes['@mozilla.org/supports-string;1'].createInstance( Components.interfaces.nsISupportsString );
 }

 this.copy = Clipboard_copy;
 this.paste = Clipboard_paste;
 }

 /**
	 * Copie une chaine de caractère dans le presse papier. Des priviliges sont
	 * recquis
	 * 
	 * @param {string}
	 *            text Texte à copier
	 */
 function Clipboard_copy( text )
 {
 if ( nn )
 {
 field.select();
 this.clipboard.setContents( new java.awt.datatransfer.StringSelection( text ), null );
 }
 else if ( ie )
 {
 this.clipboard.value = text;
 this.clipboard.select();
 var textRange = this.clipboard.createTextRange();
 textRange.execCommand( 'copy' );
 }
 else if ( mozilla )
 {
 netscape.security.PrivilegeManager.enablePrivilege( 'UniversalXPConnect' );
 this.clipboardstring.data = text;
 var transfer = Components.classes['@mozilla.org/widget/transferable;1'].createInstance( Components.interfaces.nsITransferable );
 transfer.setTransferData( 'text/unicode', this.clipboardstring, text.length*2 );
 this.clipboard.setData( transfer, null, this.clipboardid.kGlobalClipboard );
 }
 }

 /**
	 * Renvoie le texte contenus dans le presse papier
	 * 
	 * @return {String} Attention, seul le texte pur sera renvoyé
	 */
 function Clipboard_paste()
 {
 if ( nn )
 {
 var content = this.clipboard.getContents( null );

 if ( content != null )
 {
 return content.getTransferData( java.awt.datatransfer.DataFlavor.stringFlavor );
 }
 }
 else if ( ie )
 {
 this.clipboard.value = '';
 var textRange = this.clipboard.createTextRange();
 textRange.execCommand( 'paste' );

 return this.clipboard.value;
 }
 else if ( mozilla )
 {
 netscape.security.PrivilegeManager.enablePrivilege( 'UniversalXPConnect' );
 var transfer = Components.classes['@mozilla.org/widget/transferable;1'].createInstance( Components.interfaces.nsITransferable );
 transfer.addDataFlavor( 'text/unicode' );
 this.clipboard.getData( transfer, this.clipboardid.kGlobalClipboard );
 var str = new Object();
 var strLength = new Object();
 transfer.getTransferData( 'text/unicode', str, strLength );
 str = str.value.QueryInterface( Components.interfaces.nsISupportsString );
 return str.data.substring( 0, strLength.value / 2 );
 }
 }
 function findPos(obj) {
 var curleft = curtop = 0;
 if (obj.offsetParent) {
 do {
 curleft += obj.offsetLeft;
 curtop += obj.offsetTop;
 } while (obj = obj.offsetParent);
 return [curleft,curtop];
 }
 }

