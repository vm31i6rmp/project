import React from 'react'
import AppBar from '@mui/material/AppBar'
import Toolbar from '@mui/material/Toolbar'
import Typography from '@mui/material/Typography'
import NewspaperIcon from '@mui/icons-material/Newspaper';
// import { Grid } from '@mui/material';

const Header: React.FC = () => {
  return (
    <AppBar position='static'>
      <Toolbar>
        <NewspaperIcon sx={{ display: { xs: 'none', md: 'flex' }, mr: 1 }} />
        <Typography
          variant="h6"
          noWrap
          component="a"
          href="/"
          sx={{
            mr: 2,
            display: { xs: 'none', md: 'flex' },
            fontFamily: 'monospace',
            fontWeight: 700,
            letterSpacing: '.3rem',
            color: 'inherit',
            textDecoration: 'none',
          }}
        >
          NewsSite
        </Typography>
      </Toolbar>
    </AppBar>
  )
}

export default Header;