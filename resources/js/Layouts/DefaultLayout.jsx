import { faCopyright } from '@fortawesome/pro-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'

export const DefaultLayout = ({ children }) => {
  return (
    <div className="flex h-full min-h-screen w-full flex-col items-center justify-start">
      {children}

      <footer className="flex w-full flex-row items-center justify-center px-4 py-6">
        <p className="text-xs font-bold text-zinc-500 opacity-80 dark:text-zinc-600">
          <a
            href="https://jeremiahashley.com"
            className="transition-all duration-200 dark:hover:text-sky-400"
            target="_blank"
            rel="noreferrer"
          >
            Jeremiah Ashley
          </a>

          {` `}

          <FontAwesomeIcon icon={faCopyright} className="text-xs" fixedWidth />

          {new Date().getFullYear()}
        </p>
      </footer>
    </div>
  )
}
