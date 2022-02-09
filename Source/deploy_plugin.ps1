# Convert credentials to PSCredential structure
$password = ConvertTo-SecureString $env:WEBSITE_PASSWORD -AsPlainText -Force
$credentials = New-Object System.Management.Automation.PSCredential ($env:WEBSITE_USERNAME, $password)
$plugins_dir = "$($env:WEBSITE_FTP_RELATIVE_CONTENT_PATH)/wp-content/plugins"
$plugin_name = "bookmakers_directory"

# FTP Session
$Client = Connect-FTP -Server $env:WEBSITE_ADDRESS -Verbose -Credential $credentials -EncryptionMode Explicit -ValidateAnyCertificate

# SSH Session
$sshClient = Connect-SSH -Server $env:WEBSITE_ADDRESS -Credential $credentials

# Get local files
$ListFiles = Get-ChildItem -LiteralPath "$($PSScriptRoot)\$($plugin_name).zip"

# Build the decompress command to use later with ssh
$decompressCommand = {
    -join("unzip -o ", "$($plugins_dir)/$($plugin_name).zip", " -d ", "$($env:WEBSITE_SSH_CONTENT_PATH)/wp-content/plugins")
}

# Upload all files at once to FTP
Send-FTPFile -Client $Client -LocalPath $ListFiles.FullName -RemotePath "$($plugins_dir)/$($ListFiles.Name)" -RemoteExists Overwrite

# Send ssh command to decompress the uploaded .zip file
Send-SSHCommand -SshClient $sshClient -Command $decompressCommand -Verbose

# We no longer need the .zip file since we decompressed so delete it
Remove-FTPFile -Client $Client -RemotePath "$($plugins_dir)/$($ListFiles.Name)"

Disconnect-FTP -Client $Client