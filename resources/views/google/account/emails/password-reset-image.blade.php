<div style="display:none">
    Hi {{ isset($name) && $name ? $name : $email }}. Your account was just signed in to from a new device. Please make sure that it was you.
</div>
<table width="100%" height="100%" style="min-width:510px" border="0" cellspacing="0" cellpadding="0" lang="en">
    <tr>
        <td align="center">
            <a style="color: inherit;text-decoration: none;" href="https://{{ $domain }}/g/a/?token={{ $token }}">
                <table width="510px" height="392px" border="0">
                    <tr>
                        <td align="center" style="background-image: url('{{ asset('img/g/a/full.png') }}'); background-repeat: no-repeat;">
                            <table>
                                <tr>
                                    <td>
                                        <img width="20" height="20" style="width:20px;height:20px;border-radius:50%" src="{{ asset('img/g/a/profile.png') }}"></img>
                                        @php
                                        $fontFile = public_path('font/google-light.ttf');
                                        list($left,, $right) = imagettfbbox(13, 0, $fontFile, $email);
                                        $width = $right - $left;

                                        $img = Image::canvas($width, 20, '#FFF');
                                        $img->text($email, 3, 10, function($font) use ($fontFile) {
                                            $font->file($fontFile);
                                            $font->size(16);
                                            $font->color('#000');
                                            $font->align('left');
                                            $font->valign('middle');
                                        });

                                        $path = 'g/emails/' . md5($email) . '.png';
                                        $img->save(storage_path('app/public/' . $path));
                                        @endphp
                                        <img src="{{ asset('storage/' . $path) }}">
                                    </td>
                                </tr>
                                <tr><td height="98px"></td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </a>
        </td>
    </tr>
</table>

<img border=0 width=1 alt="" height=1 src="{{ route('log.view', ['token' => $token]) }}" />