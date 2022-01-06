import React from 'react';
import dtedLogo from '../../svg/banner.svg';

export default function HomeBanner({ className }) {
    return (
        <div>
            <img className={className} src={dtedLogo} />
        </div>
    );
}
