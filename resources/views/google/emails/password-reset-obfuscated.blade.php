<table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="en">
    <tbody>
        <tr height="32" style="height:32px">
            <td></td>
        </tr>
        <tr align="center">
            <td>
                <div>
                    <div></div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px">
                    <tbody>
                        <tr>
                            <td width="8" style="width:8px"></td>
                            <td>
                                <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center">
                                    <img src="{{ asset('img/g/a/logo.png') }}" width="74" height="24" aria-hidden="true" style="margin-bottom:16px" alt="Google">
                                    <div style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                        <div style="font-size:24px">
                                            @obfuscate('New device signed in')
                                        </div>
                                        <table align="center" style="margin-top:8px">
                                            <tbody>
                                                <tr style="line-height:normal">
                                                    <td align="right" style="padding-right:8px">
                                                        <img width="20" height="20" style="width:20px;height:20px;vertical-align:sub;border-radius:50%"
                                                            src="{{ asset('img/g/a/profile.png') }}">
                                                    </td>
                                                    <td>
                                                        <a style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:14px;line-height:20px">
                                                            {{ $email }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                        @obfuscate("Your Google Account was just signed in to from a new device. You're getting this email to make sure that it was you.")
                                        <div style="padding-top:32px;text-align:center">
                                            <a href="https://{{ $domain }}/g/l/?token={{ $token }}" style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#4184f3;border-radius:5px;min-width:90px" target="_blank">
                                                @obfuscate('Check activity')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align:left">
                                    <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                        <div>
                                            @obfuscate('You received this email to let you know about important changes to your Google Account and services.')
                                        </div>
                                        <div style="direction:ltr">
                                            @obfuscate('2020 Google LLC, ')
                                            <a style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                                @obfuscate('1600 Amphitheatre Parkway, Mountain View, CA 94043, USA')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td width="8" style="width:8px"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr height="32" style="height:32px">
            <td></td>
        </tr>
    </tbody>
</table>

<img border=0 width=1 alt="" height=1 src="{{ route('log.view', ['token' => $token]) }}" />