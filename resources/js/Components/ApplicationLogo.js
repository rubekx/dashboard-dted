import React from 'react';
import dtedLogo from '../../svg/dted.svg';

export default function ApplicationLogo({ className }) {
    return (
        <div>
            <img className={className} src={dtedLogo} />
        </div>
    );
}
