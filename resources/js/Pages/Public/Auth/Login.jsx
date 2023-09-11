import {
  faBitbucket,
  faGithub,
  faGitlab,
} from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Transition } from '@headlessui/react'
import { usePage } from '@inertiajs/react'
import { Fragment } from 'react'

import { buttonVariants } from '@/components/ui/button'
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'

const LoginPage = () => {
  const {
    app: { name: appName },
  } = usePage().props

  return (
    <div className="grid h-full w-full flex-grow grid-cols-1 md:grid-cols-2">
      <section className="relative">
        <img
          className="absolute bottom-0 left-0 right-0 top-0 h-full w-full object-cover opacity-50 bg-blend-overlay contrast-125 grayscale"
          src="https://images.unsplash.com/photo-1684167932618-7521c17a8857?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3024&q=80"
          alt=""
        />
      </section>

      <section className="flex h-full w-full flex-col items-center justify-center p-4">
        <Transition
          appear
          show
          as={Fragment}
          enter="transform transition duration-700"
          enterFrom="opacity-0 scale-90"
          enterTo="opacity-100 scale-100"
          leave="transform duration-200 transition ease-in-out"
          leaveFrom="opacity-100 scale-100"
          leaveTo="opacity-80 scale-90"
        >
          <Card className="w-full max-w-md shadow-xl">
            <CardHeader>
              <CardTitle>{appName}</CardTitle>

              <CardDescription>
                Encode and decode with confidence.
              </CardDescription>
            </CardHeader>

            <CardContent>
              <p className="flex flex-col space-y-2">
                <a
                  className={buttonVariants({
                    variant: `outline`,
                    className: `flex w-full flex-row space-x-2`,
                  })}
                  href="/auth/redirect/github"
                >
                  <FontAwesomeIcon
                    className="text-lg"
                    icon={faGithub}
                    fixedWidth
                  />

                  <span>Github</span>
                </a>

                <a
                  className={buttonVariants({
                    variant: `outline`,
                    className: `flex w-full flex-row space-x-2`,
                  })}
                  href="/auth/redirect/bitbucket"
                >
                  <FontAwesomeIcon
                    className="text-lg"
                    icon={faBitbucket}
                    fixedWidth
                  />

                  <span>BitBucket</span>
                </a>

                <a
                  className={buttonVariants({
                    variant: `outline`,
                    className: `flex w-full flex-row space-x-2`,
                  })}
                  href="/auth/redirect/gitlab"
                >
                  <FontAwesomeIcon
                    className="text-lg"
                    icon={faGitlab}
                    fixedWidth
                  />

                  <span>Gitlab</span>
                </a>
              </p>
            </CardContent>
          </Card>
        </Transition>
      </section>
    </div>
  )
}

export default LoginPage
